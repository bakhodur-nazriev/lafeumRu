@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => $currentKnowledgeArea->name,
        'description' => $currentKnowledgeArea->description,
        'next' => $currentKnowledgeArea->terms->nextPageUrl(),
        'prev' => $currentKnowledgeArea->terms->previousPageUrl()
    ])
@endsection

@section('left-side-bar')
    <div class="left-sidebar-block">
        <h3 class="secondary">Области знаний</h3>
        <div class="my-2 form-group">
            <input
                type="string"
                id="knowledge-search"
                class="form-control"
                placeholder="Введите область знаний"
            >
            <small id="knowledge-search-result" class="form-text text-muted ml-1"></small>
        </div>

        @foreach ($knowledgeAreas as $knowledgeAreaParent)
            <h4 class="knowledge-parent secondary mb-0" style="font-size: 1rem; margin-top: 15px">
                {{$knowledgeAreaParent->name}}
            </h4>
            <hr class="mt-1" style="margin-bottom: 5px">
                @foreach ($knowledgeAreaParent->children as $knowledgeArea)
                    <div class="knowledge">
                        <a class="knowledge-area-color {{Request::is('knowledge/'.$knowledgeArea->slug) ? 'active': ''}}"
                           href="/knowledge/{{$knowledgeArea->slug}}">{{$knowledgeArea->name}}</a>
                    </div>
                @endforeach
        @endforeach

    </div>
    <script>
        $(document).ready(() => {
            attachSearch(
                "#knowledge-search",
                ".knowledge",
                '#knowledge-search-result'
            );
        })
    </script>
@endsection

@section('content')
    <h3 class="secondary mb-2">{{ $currentKnowledgeArea->name }}</h3>
    <p>{!! $currentKnowledgeArea->description !!}</p>

    @foreach($currentKnowledgeArea->terms as $term)
        @include('layouts.termItem')
    @endforeach

    <div class="col-12">
        <nav>
            <div class="row d-flex justify-content-center mt-3">
                {{ $currentKnowledgeArea->terms->links() }}
            </div>
        </nav>
    </div>

    @if (count($currentKnowledgeArea->linked_knowledge))
        <div>
            <h4 class="secondary mb-0">Смотрите также:</h4>
            <hr class="mt-1">
            <ul class="ml-3">
                @foreach ($currentKnowledgeArea->linked_knowledge as $linkedKnowledge)
                    <li>
                        <a href="/knowledge/{{$linkedKnowledge->slug}}">{{$linkedKnowledge->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

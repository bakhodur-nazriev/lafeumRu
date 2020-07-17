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
        @foreach($knowledgeAreas as $knowledgeArea)
            <div><a href="#">{{ $knowledgeArea->name }}</a></div>
        @endforeach
    </div>
@endsection

@section('content')
    <h3 class="secondary mb-2">{{ $currentKnowledgeArea->name }}</h3>
    <p>{{ $currentKnowledgeArea->description }}</p>
    
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

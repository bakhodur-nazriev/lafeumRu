@extends('layouts.default')

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
        <nav aria-label="Page navigation example">
            <div class="row d-flex justify-content-center mt-3">
                {{ $currentKnowledgeArea->terms->links() }}
            </div>
        </nav>
    </div>
@endsection

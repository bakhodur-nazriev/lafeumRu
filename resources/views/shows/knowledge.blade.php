@extends('layouts.default')

@section('content')
    <div class="left-sidebar-block">
        <h3 class="secondary">Области знаний</h3>
        @foreach($knowledgeAreas as $knowledgeArea)
            <div><a href="#">{{ $knowledgeArea->name }}</a></div>
        @endforeach
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="secondary mb-2">{{ $currentKnowledgeArea->name }}</h3>
                <p>{{ $currentKnowledgeArea->description }}</p>
                @foreach($currentKnowledgeArea->terms as $term)
                    @include('layouts.termItem')
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.right-sidebar.rightSidebar')
@endsection

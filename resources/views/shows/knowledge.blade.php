@extends('layouts.default')

@section('content')
    <div class="row card-main-block">
        <div class="col-md-3 col-sm-12 p-0">
            <div class="left-sidebar-block">
                <h3 class="secondary">Области знаний</h3>
                @foreach($knowledgeAreas as $knowledgeArea)
                    <div><a href="#">{{ $knowledgeArea->name }}</a></div>
                @endforeach
            </div>
        </div>
        <div class="col-md-9 d-flex justify-content-around">
            <div class="col-md-7">

                <h3 class="secondary mb-2">{{ $currentKnowledgeArea->name }}</h3>
                <p>{{ $currentKnowledgeArea->description }}</p>
                @foreach($currentKnowledgeArea->terms as $term)
                    @include('layouts.termItem')
                @endforeach
            </div>
            @include('layouts.rightSidebar')
        </div>
    </div>
@endsection

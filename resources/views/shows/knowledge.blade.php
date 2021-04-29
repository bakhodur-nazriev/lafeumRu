@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => $currentKnowledgeArea->name,
        'description' => $currentKnowledgeArea->description,

    ])
@endsection

@section('content')
    <knowledge-area-left-sidebar></knowledge-area-left-sidebar>
    <knowledge 
        :current-knowledge-area="{{ $currentKnowledgeArea }}"
    ></knowledge>
@endsection

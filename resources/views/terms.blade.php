@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Термины',
        'description' => '',
        'next' => $terms->nextPageUrl(),
        'prev' => $terms->previousPageUrl()
    ])
@endsection

@section('left-side-bar')
    @include('layouts.left-sidebar.leftSidebar', ['type' => 'App\Term'])
@endsection

@section('content')
    <terms></terms>
    
    {{-- @foreach($terms as $term)
        @include('layouts.termItem')
    @endforeach --}}
@endsection

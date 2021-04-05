@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Термины',
        'description' => ''
    ])
@endsection

{{--@section('left-side-bar')--}}
{{--    @include('layouts.left-sidebar.leftSidebar', ['type' => 'App\Term'])--}}
{{--@endsection--}}

@section('content')
    <left-side-bar></left-side-bar>
    <terms :terms="{{ $terms }}"></terms>

    {{-- @foreach($terms as $term)
        @include('layouts.termItem')
    @endforeach --}}
@endsection

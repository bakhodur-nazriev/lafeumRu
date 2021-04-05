@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Видео',
        'description' => ''
    ])
@endsection

{{--@section('left-side-bar')--}}
{{--    @include('layouts.left-sidebar.leftSidebar', ['type' => 'App\Video'])--}}
{{--@endsection--}}

@section('content')
    <left-side-bar></left-side-bar>
    <videos></videos>

    {{-- <div class="row">
        @foreach($videos as $video)
            @include('layouts.videoItem')
        @endforeach
    </div> --}}
@endsection

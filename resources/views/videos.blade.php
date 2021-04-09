@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Видео',
        'description' => ''
    ])
@endsection

@section('content')
    @include('layouts.left-sidebar.left-side-bar', ['type' => 'App\Video'])
    <videos></videos>

    {{-- <div class="row">
        @foreach($videos as $video)
            @include('layouts.videoItem')
        @endforeach
    </div> --}}
@endsection

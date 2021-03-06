@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Видео',
        'description' => '',
        'next' => $videos->nextPageUrl(),
        'prev' => $videos->previousPageUrl()
    ])
@endsection

@section('left-side-bar')
    @include('layouts.left-sidebar.leftSidebar', ['type' => 'App\Video'])
@endsection

@section('content')
    <h3 class="secondary">Видео</h3>
    <div class="row">
        @foreach($videos as $video)
            @include('layouts.videoItem')
        @endforeach
    </div>
@endsection

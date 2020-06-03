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
    @include('layouts.left-sidebar.categories', ['type' => 'App\Video'])
@endsection

@section('content')
    <h3 class="secondary">Видео</h3>
    <div class="row">
        @foreach($videos as $video)
            @include('layouts.videoItem')
        @endforeach
        @include('layouts.unauthorizeModal')
    </div>
    <nav aria-label="Page navigation example">
        <div class="row d-flex justify-content-center mt-3">
            {{ $videos->links() }}
        </div>
    </nav>
@endsection

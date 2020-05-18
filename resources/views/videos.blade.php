@extends('layouts.default')

@section('content')
    @include('layouts.left-sidebar.categories', ['type' => 'App\Video'])
    <div class="container">
        <div class="row">
            <h3 class="secondary ml-3">Видео</h3>
            <div class="col-lg-12 text-center">
                @foreach($videos as $video)
                    @include('layouts.videoItem')
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.right-sidebar.rightSidebar')
@endsection
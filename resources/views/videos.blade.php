@extends('layouts.default')

@section('left-side-bar')
    @include('layouts.left-sidebar.categories', ['type' => 'App\Video'])
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h3 class="secondary ml-3">Видео</h3>
            <div class="col-lg-12 text-center">
                <div class="row">
                    @foreach($videos as $video)
                        @include('layouts.videoItem')
                    @endforeach
                </div>
                <nav aria-label="Page navigation example">
                    <div class="row d-flex justify-content-center mt-3">
                        {{ $videos->links() }}
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection

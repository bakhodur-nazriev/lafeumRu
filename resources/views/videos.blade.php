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
                <div class="col-12">
                    <nav aria-label="Page navigation example">
                        <div class="row d-flex justify-content-center mt-3">
                            {{ $videos->links() }}
                        </div>
                    </nav>
                </div>
            </div>
            <button class="btn btn-primary btnScrollToTop">
                <i class="fa fa-arrow-up"></i>
            </button>
        </div>
    </div>
    @include('layouts.right-sidebar.rightSidebar')
@endsection


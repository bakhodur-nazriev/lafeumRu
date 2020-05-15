@extends('layouts.default')

@section('content')
    <div class="row card-main-block">
        @include('layouts.categories', ['type' => 'App\Video'])

        <div class="col-sm-12 col-md-10 col-lg-10 d-flex justify-content-around">
            <div class="col-md-7 col-lg-9 d-flex flex-wrap justify-content-center">
                <div class="col-lg-10">
                    <h3 class="secondary">Видео</h3>
                </div>
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
            <div class="col-md-12 col-lg-3 d-flex flex-column">
                @include('layouts.rightSidebarUserBlock')
                @include('layouts.postsSidebarPostsBlock')
            </div>
        </div>
    </div>
@endsection


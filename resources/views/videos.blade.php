@extends('layouts.default')

@section('content')
<div class="row card-main-block">
    @include('layouts.categories', ['type' => 'App\Video'])
    <div class="col-xl-9 d-flex justify-content-between">
        <div class="col-md-7">
            <h3 class="secondary">Видео</h3>
            <div class="row">
                @foreach($videos as $video)
                    @include('layouts.videoItem')
                @endforeach
            </div>
            <div class="col-12">
                <nav aria-label="Page navigation example">
                    <div class="row d-flex justify-content-center mt-3">
                        {{ $videos->links() }}
                    </div>
                </nav>
            </div>
        </div>
        <div class="col-md-12 col-lg-4 d-flex flex-column">
            @include('layouts.rightSidebarUserBlock')
            @include('layouts.postsSidebarPostsBlock')
        </div>
    </div>
</div>
@endsection
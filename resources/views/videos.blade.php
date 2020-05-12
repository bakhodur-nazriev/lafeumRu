@extends('layouts.default')

@section('content')
    <div class="row card-main-block">
        @include('layouts.categories', ['type' => 'App\Video'])
        <div class="col-xl-9 d-flex">
            <div class="col-md-8 p-0">
                <h3 class="secondary ml-3">Видео</h3>
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
            @include('layouts.rightSidebar')
        </div>
    </div>

    <script>
        function videoToggleFavourite(videoId, onSuccess = null, onFailure = null) {
            const videoModel = "App\\Video";
            $.ajax({
                url: '/toggle-favourite',
                method: 'PUT',
                data: {
                    "_token": window.Laravel.csrf_token,
                    favouritable: videoModel,
                    id: videoId
                }
            }).then(onSuccess).catch(onFailure);
        }

        $(document).ready(() => {
            $('.favourite-video-btn').click(e => {
                let button = e.target;
                let id = button.dataset.id;

                videoToggleFavourite(id, (isFavourite) => {
                    button.classList.toggle('fa-star-active', isFavourite);
                });
            });
        });
    </script>
@endsection


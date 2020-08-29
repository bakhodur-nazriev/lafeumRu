@php
    if(isset($item) && !isset($video)){
        $video = $item;
    }

    if(!isset($fullVariant)) {
        $fullVariant = false;
    }
@endphp

<div class="right-sidebar-block my-4">
    <a href="/{{$dailyPosts->video->post->id}}" target="_blank">
        <div class="title-of-right-sidebar-posts">
            <h5 class="pl-3 py-2 mb-0">Видео дня</h5>
        </div>
    </a>

    <div class="row w-100 m-0">
        <div class="col-12 p-3">
            <div
                class="modal fade"
                id="video-{{$dailyPosts->video->post->id}}-modal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="video-{{$dailyPosts->video->post->id}}-modal-title"
                style="display: none;"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"
                                id="video-{{$dailyPosts->video->post->id}}-modal-title">{{$dailyPosts->video->title}}</h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                                onclick="onCloseVideoModal()"
                            >
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <iframe
                                class="video-iframe"
                                src="{{$dailyPosts->video->embeded_link}}?enablejsapi=1"
                                frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen=""
                            ></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="text-right position-relative cursor-pointer"
                onclick="showVideoModal('#video-{{$dailyPosts->video->post->id}}-modal', {{$dailyPosts->video->post->id}})"
            >
                <img class="w-100" src="{{$dailyPosts->video->thumbnail}}"/>
                <span class="video-duration-block">{{$dailyPosts->video->duration}}:00</span>
            </div>
        </div>
        <div class="{{$fullVariant ? 'col-12': 'col-md-8 col-12 pl-md-0 py-0'}}">
            <div class="d-flex flex-row justify-content-between">

            </div>
        </div>
    </div>
</div>

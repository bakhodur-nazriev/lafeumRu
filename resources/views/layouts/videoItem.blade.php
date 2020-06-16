@php
    if(isset($item) && !isset($video)){
        $video = $item;
    }

    if(!isset($fullVariant)) {
        $fullVariant = false;
    }
@endphp
<div class="col-12">
    <div class="card h-100 p-3">
        <div class="row mb-3">
            @if ($fullVariant)
                <div class="col-12 pt-0">
                    <iframe
                        class="video-iframe"
                        src="{{$video->embeded_link}}?enablejsapi=1"
                        frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""
                    ></iframe>
                </div>
            @else
                <div class="col-md-4 col-12 py-0">
                    <div
                        class="modal fade"
                        id="video-{{$video->id}}-modal"
                        tabindex="-1"
                        role="dialog"
                        data-backdrop="static"
                        data-keyboard="false"
                        aria-labelledby="video-{{$video->id}}-modal-title"
                        style="display: none;"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5
                                        class="modal-title"
                                        id="video-{{$video->id}}-modal-title"
                                    >
                                        {{$video->title}}
                                    </h5>
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
                                        src="{{$video->embeded_link}}?enablejsapi=1"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen=""
                                    ></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="text-right position-relative"
                        data-toggle="modal"
                        data-target="#video-{{$video->id}}-modal"
                    >
                        <img class="img-thumbnail w-100" src="{{$video->thumbnail}}"/>
                        <span class="video-duration-block">{{$video->duration}}:00</span>
                    </div>
                </div>
            @endif
            <div class="{{$fullVariant ? 'col-12': 'col-md-8 col-12 pl-md-0 py-0'}}">
                <div class="d-flex flex-row justify-content-between">
                    <h5 class="card-title d-inline-block" data-toggle="modal"
                        data-target="#video-{{$video->id}}-modal">{{$video->title}}</h5>
                    <div class="d-flex flex-row" style="height: fit-content">
                        <a class="secondary" href="/{{$video->post->id}}">
                            #{{$video->post->id}}
                        </a>
                        @guest
                            <i data-id="{{$video->id}}"
                               class="ml-2 fa fa-star favourite-quote-btn {{$video->isFavorited() ? " fa-star-active": ""}}"
                               data-toggle="modal" data-target=".modal" data-placement="top" title="Избранный"></i>
                        @endguest
                        @auth
                            <i data-id="{{$video->id}}"
                               class="ml-2 fa fa-star favourite-quote-btn {{$video->isFavorited() ? " fa-star-active": ""}}"
                               data-toggle="tooltip" data-placement="top" title="Избранный"></i>
                        @endauth
                    </div>
                </div>

                <a
                    href="/channels/{{ $video->channel->slug }}"
                    class="secondary d-inline-block mb-2"
                >
                    <i class="fa fa-youtube-play mr-2"></i>{{$video->channel->name}}
                </a>
                <div class="inner-categories mb-0">
                    @foreach($video->categories as $category)
                        <a href="/videos/{{ $category->slug }}" class="mr-1">
                            <i class="fa fa-tags mr-1"></i>{{$category->name}}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card-footer p-0 pt-2" style="background-color: white;">
            <div class="dropdown share-button-dropdown-block">
                <button class="share-button">Поделиться</button>
                <div class="dropdown-content-share-button">
                    <a
                        data-url="http://new.lafeum.org/{{ $video->post->id }}"
                        class="ya-share2"
                        data-services="vkontakte,facebook,odnoklassniki,twitter,viber,whatsapp,telegram"
                        href="/{{ $video->post->id }}"
                    >
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

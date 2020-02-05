@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3>Темы</h3>
                <div>
                    @foreach($categories as $category)
                        <a href="">{{ $category->name }}<br></a>
                    @endforeach
                </div>
            </div>

            <div class="col-md-9">
                @foreach ($videos as $video)
                    {{-- <div class="col-md-4 m-3"> --}}
                    <div class="card mb-4 m-3 shadow-sm single-video-block">
                        <div class="videos-channels-title">
                            <a href="#">
                                <img src="/img/youtube.png" alt="">
                                <span>{{ $video->title }}</span>
                            </a>
                        </div>
                        <div class="main-content-video">
                            <iframe src="{{ $video->link }}">

                            </iframe>
                            <svg class="bd-placeholder-img card-img-top"
                                 width="100%"
                                 height="225"
                                 xmlns="http://www.w3.org/2000/svg"
                                 preserveAspectRatio="xMidYMid slice"
                                 focusable="false"
                                 role="img"
                                 aria-label="Placeholder: Thumbnail"
                            >
                                <rect width="100%" height="100%" fill="#55595c"/>
                            </svg>
                        </div>
                        <div class="card-body">
                            <p>{{ $video->channel->description }}</p>
                            <div class="d-flex justify-content-end text-muted mb-2">
                                {{--<v-icon left prepend-icon="mdi-clock-outline"></v-icon>--}}
                                9 mins
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="d-flex justify-content-between align-items-center flex-wrap">

                                <div class="btn-group">
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-secondary"
                                    >Поделиться
                                    </button>
                                    <div class="video-share">
                                        <a href="#"><img src="/img/social_icons/vk.png" alt=""></a>
                                        <a href="#"><img src="/img/social_icons/facebook.png" alt=""></a>
                                        <a href="#"><img src="/img/social_icons/odnoklassniki.png" alt=""></a>
                                        <a href="#"><img src="/img/social_icons/twitter.png" alt=""></a>
                                        <a href="#"><img src="/img/social_icons/viber.png" alt=""></a>
                                        <a href="#"><img src="/img/social_icons/whatsapp.png" alt=""></a>
                                        <a href="#"><img src="/img/social_icons/telegram.png" alt="telegram link"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </div> --}}
                @endforeach
            </div>

        </div>
    </div>
@endsection


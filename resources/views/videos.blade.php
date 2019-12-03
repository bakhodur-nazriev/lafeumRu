@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h3>Темы</h3>
            <a href="">Достижения и Упорство</a>
        </div>

        @foreach ($videos as $video)
            <div class="col-md-4 col-xl-3 offset-md-1">
                <div class="card mb-4 shadow-sm">
                    <div class="videos-channels-title">
                        <a href="#">
                            <img src="/img/youtube.png" alt="">
                            <span>{{ $video->title }}</span>
                        </a>
                    </div>
                    <div class="main-content-video">
                        <svg class="bd-placeholder-img card-img-top"
                            width="100%"
                            height="225"
                            xmlns="http://www.w3.org/2000/svg"
                            preserveAspectRatio="xMidYMid slice"
                            focusable="false"
                            role="img"
                            aria-label="Placeholder: Thumbnail"
                        >
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"/>
                        </svg>
                    </div>
                    <div class="card-body">
                        @foreach ($video->channel as $chan)
                            <p class="card-text">{{ $chan->name }}</p>

                        @endforeach
                        <div class="dropdown-divider"></div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Поделиться</button>
                            </div>
                            <small class="text-muted">
                                <v-icon left>mdi-clock-outline</v-icon>9 mins
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="videos-channels-title">
                    <a href="#">
                        <img src="/img/youtube.png" alt="">
                        <span>Онлайн-курсы Юрайт</span>
                    </a>
                </div>
                <div class="main-content-video">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c"/>
                    </svg>
                </div>
                <div class="card-body">
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Поделиться</button>
                        </div>
                        <small class="text-muted">
                            <v-icon left>mdi-clock-outline</v-icon>9 mins
                        </small>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection

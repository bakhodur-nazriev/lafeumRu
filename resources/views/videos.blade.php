@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row card-main-block">
            @include('layouts.categories', ['type' => 'App\Video'])
            <div class="col-md-9 col-xl-9">
                <h3 class="secondary ml-3">Видео</h3>
                <div class="row">
                    @foreach($videos as $video)
                        <div class="col-6">
                            <div class="card h-100">
                                <iframe class="youtube-videos" src="{{$video->link}}" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen="">
                                </iframe>
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title">{{$video->title}}</h5>
                                    <div>
                                        <p class="text-muted mb-0">
                                            <a href="/channels/{{ $video->channel->slug }}" class="d-block">
                                                <i class="fa fa-youtube-play secondary mr-2"></i>{{$video->channel->name}}
                                            </a>
                                        </p>
                                        @foreach($video->categories as $category)
                                            <p class="d-inline-block mb-0">
                                                <a href="#"><i class="fa fa-tags mr-1"></i>{{$category->name}},</a>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="fa fa-clock-o mr-1"></i>{{$video->duration}}
                                        <span> мин.</span>
                                    </span>
                                    <button class="btn share-button">Поделиться</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation example">
                            <div class="row d-flex justify-content-center mt-3">
                                {{ $videos->links() }}
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


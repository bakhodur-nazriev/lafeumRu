@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row card-main-block">
            @include('layouts.categories', ['type' => 'App\Video'])
            <div class="col-md-9 col-xl-9">
                <h3 class="secondary ml-3">Видео</h3>
                <div class="row">
                    @foreach($videos as $video)
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="video-link-block">
                                    <p class="video-channel-link">
                                        <a href="/channels/{{ $video->channel->slug }}" class="secondary">
                                            <i class="fa fa-youtube-play mr-2"></i>{{$video->channel->name}}
                                        </a>
                                    </p>
                                </div>
                                <iframe class="youtube-videos" src="{{$video->link}}" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen="">
                                </iframe>
                                <div class="card-body d-flex flex-column justify-content-between pt-0">
                                    <h5 class="card-title">{{$video->title}}</h5>
                                    <div class="inner-categories mb-0">
                                        @foreach($video->categories as $category)
                                            <a href="#" class="mr-1">
                                                <i class="fa fa-tags mr-1"></i>{{$category->name}},
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="fa fa-clock-o mr-1"></i>{{$video->duration}}
                                        <span> мин.</span>
                                    </span>
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


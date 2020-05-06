@extends("layouts.default")

@section("content")
    <div class="row card-main-block">
        <div class="col-md-12 col-lg-2 col-sm-12 p-0 shows-left-block">
            <div class="left-sidebar-block">
                <h3 class="secondary">Каналы YouTube</h3>
                <div class="mb-3">
                    <p class="p-1 mb-0">Введите название канала</p>
                    <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon"
                           aria-describedby="button-addon1">
                </div>
                @foreach($channels as $channelItem)
                    <a href="/channels/{{$channelItem->slug}}">
                        {{ $channelItem->name }}
                    </a><br>
                @endforeach
            </div>
        </div>
        <div class="col-md-12 col-lg-9 d-flex shows-content-and-right-block">
            <div class="col-md-12 col-lg-8">
                <h3 class="secondary">{{ $channel->name }}</h3>
                <p>{{ $channel->description }}</p>
                <div class="row">
                    @foreach($channel->videos as $video)
                        <div class="col-lg-6">
                            <div class="card h-100">
                                <div class="col video-link-block">
                                    <p class="video-channel-link">
                                        <a href="/channels/{{ $video->channel->slug }}" class="secondary">
                                            <i class="fa fa-youtube-play mr-2"></i>{{$video->channel->name}}
                                        </a>
                                    </p>
                                    <i data-id="{{$video->id}}"
                                       class="fa fa-star favourite-video-btn {{$video->isFavorited() ? " fa-star-active": ""}}"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Избранный"
                                    ></i>
                                </div>
                                <iframe class="youtube-videos" src="{{$video->link}}" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen="">
                                </iframe>
                                <div class="card-body d-flex flex-column justify-content-between pt-0">
                                    <h5 class="card-title">{{$video->title}}</h5>
                                    <div class="inner-categories mb-0">
                                        @foreach($video->categories as $category)
                                            <a href="#" class="mb-0">
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
                                    <button class="btn share-button">Поделиться</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @include('layouts.rightSidebar')
        </div>
    </div>
@endsection

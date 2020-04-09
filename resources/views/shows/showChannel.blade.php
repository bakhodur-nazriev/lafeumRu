@extends("layouts.default")

@section("content")
    <div class="container">
        <div class="row card-main-block">
            <div class="col-md-3 col-sm-12 themes-block">
                <h3 class="secondary">Каналы YouTube</h3>
                <input type="text">
                @foreach($channels as $channelItem)
                    <a href="/channels/{{$channelItem->slug}}">
                        <b>{{ $channelItem->name }}</b>
                    </a><br>
                @endforeach
            </div>
            <div class="col-md">
                <h3 class="secondary">{{ $channel->name }}</h3>
                <p>{{ $channel->description }}</p>

                <div class="row">
                    @foreach($channel->videos as $video)
                        <div class="col-6">
                            <div class="card h-100">
                                <iframe class="youtube-videos" src="{{$video->link}}" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen="">
                                </iframe>
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title mb-0">{{$video->title}}</h5>
                                    <div>

                                        <p class="text-muted mb-0">
                                            <a href="/channels/{{$channel->slug}}" class="d-block secondary">
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
            </div>
        </div>
    </div>
@endsection

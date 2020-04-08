@extends("layouts.default")

@section("content")
    <div class="container">
        <div class="row card-main-block">
            <div class="col-md-3 col-sm-12">
                <h3 class="secondary">Темы</h3>
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
                    @foreach($channels->videos as $video)
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body ">
                                    <h5 class="card-title mb-0">{{$video->title}}</h5>
                                    <p class="text-muted">
                                        {{--<a href="/channels/{{$channels->id}}" class="d-block secondary">
                                            <i class="fa fa-youtube-play mr-2"></i>{{$channels->name}}
                                        </a>--}}
                                    </p>
                                    <iframe class="youtube-videos" src="{{--{{$video->link}}--}}"
                                            frameborder="0"></iframe>
                                    {{--@foreach($videos->tags as $tag)--}}
                                    <p class="mb-0 mr-1">
                                        <a href="#"><i class="fa fa-tags mr-1"></i>{{--{{$tag->name}},--}}</a>
                                    </p>
                                    {{--@endforeach--}}
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="fa fa-clock-o mr-1"></i>{{--{{$video->duration}}--}}
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

@php
    if(isset($item) && !isset($video)){
        $video = $item;
    }
@endphp
<div class="col-6">
    <div class="card h-100">
        <div class="video-link-block">
            <a href="/channels/{{ $video->channel->slug }}" class="secondary">
                <i class="fa fa-youtube-play mr-2"></i>{{$video->channel->name}}
            </a>
            <a class="secondary mr-2" href="/{{ $video->post->id }}">{{ $video->post->id }}</a>
            @guest
                <i data-id="{{$video->id}}"
                   class="fa fa-star favourite-quote-btn {{$video->isFavorited() ? " fa-star-active": ""}}"
                   data-toggle="modal"
                   data-target=".modal"
                   data-placement="top"
                   title="Избранный"
                ></i>
            @endguest
            @auth
                <i data-id="{{$video->id}}"
                   class="fa fa-star favourite-quote-btn {{$video->isFavorited() ? " fa-star-active": ""}}"
                   data-toggle="tooltip"
                   data-placement="top"
                   title="Избранный"
                ></i>
            @endauth
        </div>
        <iframe class="youtube-videos" src="{{$video->link}}" frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="">
        </iframe>
        <div class="card-body d-flex flex-column justify-content-between pt-0">
            <h5 class="card-title">{{$video->title}}</h5>
            <div class="inner-categories mb-0">
                @foreach($video->categories as $category)
                    <a href="/videos/{{ $category->slug }}" class="mr-1">
                        <i class="fa fa-tags mr-1"></i>{{$category->name}},
                    </a>
                @endforeach
            </div>
            <div>
                <i class="fa fa-clock-o mr-1"></i>{{$video->duration}}
                <span> мин.</span>
            </div>
        </div>
        <div class="card-footer">
            <div class="dropdown">
                <button class="share-button">Поделиться</button>
                <div class="dropdown-content">
                    <a
                        data-url="http://new.lafeum.org/{{ $video->post->id }}"
                        class="addthis_inline_share_toolbox"
                        href="/{{ $video->post->id }}">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

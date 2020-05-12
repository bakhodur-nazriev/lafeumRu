<div class="col-md-5 col-lg-5 px-2 d-inline-block">
    <div class="card video-card-block">
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
                    <a href="#" class="mr-1">
                        <i class="fa fa-tags mr-1"></i>{{$category->name}},
                    </a>
                @endforeach
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <a class="share-button video-share-button">
                <div class="share-text">Поделиться</div>
                <div class="share"></div>
            </a>
            <span>
                    <i class="fa fa-clock-o mr-1"></i>{{$video->duration}}
                    <span> мин.</span>
                </span>
        </div>
    </div>
</div>
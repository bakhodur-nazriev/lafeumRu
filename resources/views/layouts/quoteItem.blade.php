@php
    if(isset($item) && !isset($qoute)){
        $quote = $item;
    }
@endphp

<div class="card-block">
    <div class="row px-3 mb-2">
        <div class="py-0">
            <a href="/authors/{{$quote->author->slug}}" class="secondary">
                <i class="fa fa-user" style="margin-right: 5px;"></i>{{$quote->author->name}}
            </a>
        </div>
        <div class="col p-0 text-right">
            <a class="secondary mr-2" href="/{{ $quote->post->id }}">#{{ $quote->post->id }}</a>
            @guest
                <i data-id="{{$quote->id}}"
                   class="fa fa-star favourite-quote-btn {{$quote->isFavorited() ? " fa-star-active": ""}}"
                   data-toggle="modal"
                   data-target=".modal"
                   data-placement="top"
                   title="Избранный"
                ></i>
            @endguest
            @auth
                <i data-id="{{$quote->id}}"
                   class="fa fa-star favourite-quote-btn {{$quote->isFavorited() ? " fa-star-active": ""}}"
                   data-toggle="tooltip"
                   data-placement="top"
                   title="Избранный"
                ></i>
            @endauth
        </div>
    </div>
    <div class="mb-1">{!! $quote->body !!}</div>
    <div class="tags-block">
        @foreach($quote->categories as $category)
            <a class="tags-color" href="/quotes/{{ $category->slug }}">
                <i class="fa fa-tags"></i>
                {{ $category->name }}
            </a>
        @endforeach
    </div>
    <div class="my-main-divider"></div>

    <div class="dropdown share-button-dropdown-block">
        <button class="share-button">Поделиться</button>
        <div class="dropdown-content-share-button">
            <a
                data-url="http://new.lafeum.org/{{ $quote->post->id }}"
                class="ya-share2"
                data-services="vkontakte,facebook,odnoklassniki,twitter,viber,whatsapp,telegram"
                href="/{{ $quote->post->id }}"
            >
            </a>
        </div>
    </div>
</div>

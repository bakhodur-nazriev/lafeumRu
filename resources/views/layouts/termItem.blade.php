@php
    if(isset($item) && !isset($term)){
        $term = $item;
    }
@endphp

<div class="card-block summary-links-wrapper">
    <div class="row px-3 mb-2 d-flex">
        <div class="col-6 p-0 atom-icon-block">
            <img src="/img/icons/atom.png"/>
            <img src="/img/icons/atom.png"/>
            <img src="/img/icons/atom.png"/>
        </div>
        <div class="col-6 p-0 text-right">
            <a class="secondary mr-2 ignore-summary" href="/{{ $term->post->id }}">#{{$term->post->id}}</a>
            @guest
                <i data-id="{{$term->id}}"
                   class="fa fa-star favourite-quote-btn {{$term->isFavorited() ? " fa-star-active": ""}}"
                   data-toggle="modal"
                   data-target=".modal"
                   data-placement="top"
                   title="Избранный"
                ></i>
            @endguest
            @auth
                <i data-id="{{$term->id}}"
                   class="fa fa-star favourite-quote-btn {{$term->isFavorited() ? " fa-star-active": ""}}"
                   data-toggle="tooltip"
                   data-placement="top"
                   title="Избранный"
                ></i>
            @endauth
        </div>
    </div>
    <div class="mb-1">{!! $term->body !!}</div>
    <div class="tags-block">
        @foreach($term->categories as $category)
            <a href="/terms/{{ $category->slug }}">
                <i class="fa fa-tags"></i>
                {{ $category->name }}
            </a>
        @endforeach
    </div>
    <div class="my-main-divider"></div>

    <div class="dropdown share-button-dropdown-block">
        <button class="share-button">Поделиться</button>
        <div class="dropdown-content">
            <a
                data-utl="http://new.lafeum.org/{{$term->post->id}}"
                class="addthis_inline_share_toolbox"
                href="/{{ $term->post->id }}">
            </a>
        </div>
    </div>

</div>

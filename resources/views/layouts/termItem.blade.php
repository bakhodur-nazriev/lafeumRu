@php
    if(isset($item) && !isset($term)){
        $term = $item;
    }
@endphp

<div class="card-block">
    <div class="row px-3 mb-2 d-flex">
        <div class="col-6 p-0 atom-icon-block">
            <img src="/img/icons/atom.png"/>
            <img src="/img/icons/atom.png"/>
            <img src="/img/icons/atom.png"/>
        </div>
        <div class="col-6 p-0 text-right">
            <a class="secondary mr-2" href="/{{ $term->post->id }}">{{$term->post->id}}</a>
            <i data-id="{{$term->id}}"
               class="fa fa-star favourite-term-btn {{$term->isFavorited() ? " fa-star-active": ""}}"
               data-toggle="tooltip"
               data-placement="top"
               title="Избранный"
            ></i>
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

    <div class="dropdown">
        <button class="share-button">Поделиться</button>
        <div class="dropdown-content">
            <a href="/{{ $term->post->id }}">
                <div class="addthis_inline_share_toolbox"></div>
            </a>
        </div>
    </div>

</div>

@php
    if(isset($item) && !isset($term)){
        $term = $item;
    }
@endphp

<div class="card-block">
    <div class="row px-3 mb-2 d-flex">
        <div class="col-6 p-0">
            <p class="mb-1">
                <i class="fa fa-diamond secondary"></i>
                <i class="fa fa-diamond secondary"></i>
                <i class="fa fa-diamond secondary"></i>
            </p>
        </div>
        <div class="col-6 p-0 text-right">
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
    <a class="share-button">
        <div class="share-text">Поделиться</div>
        <div class="share"></div>
    </a>
</div>
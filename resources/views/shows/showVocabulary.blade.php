@extends("layouts.default")

@section("content")
    <div class="container">
        <div class="row card-block my-2">
            <div class="col-md-11 my-0 lol">
                {!! $term->body !!}
            </div>
            <div class="col-md-1 text-center">
                <i data-id="{{$term->id}}"
                   class="fa fa-star favourite-quote-btn {{$term->isFavorited() ? " fa-star-active": ""}}"
                   data-toggle="tooltip"
                   data-placement="top"
                   title="Избранный"
                ></i>
            </div>
            <div class="tags-block">
                @foreach($term->tags as $tag)
                    <a href="#">
                        <img src="/img/tag.png" alt="" class="qouter-authors-image">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
            <div class="my-main-divider"></div>
            <button class="btn share-button">Поделиться</button>
        </div>
    </div>
@endsection

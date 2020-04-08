@extends("layouts.default")

@section("content")
    <div class="container">
        <div class="row card-block my-2">
            <div class="card-block">
                <div class="row">
                    <div class="col py-0 text-right">
                        {{--<i data-id="{{$term->id}}"
                           class="fa fa-star favourite-quote-btn {{$term->isFavorited() ? " fa-star-active": ""}}"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Избранный"
                        ></i>--}}
                    </div>
                </div>
                <p class="mb-1">
                    <i class="fa fa-diamond secondary"></i>
                    <i class="fa fa-diamond secondary"></i>
                    <i class="fa fa-diamond secondary"></i>
                </p>
                <p>{!! $term->body !!}</p>
                <div class="tags-block">
                    @foreach($term->categories as $category)
                        <a href="#">
                            <i class="fa fa-tags"></i>
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
                <div class="my-main-divider"></div>
                <button class="btn share-button">Поделиться</button>
            </div>
        </div>
    </div>
@endsection

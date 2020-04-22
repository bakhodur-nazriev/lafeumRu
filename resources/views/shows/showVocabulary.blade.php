@extends("layouts.default")

@section("content")
    <div class="container">
        <div class="m-0 mt-3 card-block">
            <div class="row px-3">
                <div class="py-0">
                    <span class="mb-1">
                        <i class="fa fa-diamond secondary"></i>
                        <i class="fa fa-diamond secondary"></i>
                        <i class="fa fa-diamond secondary"></i>
                    </span>
                </div>
                <div class="col p-0 text-right">
                    <i data-id="{{$vocabulary->id}}"
                       class="fa fa-star favourite-quote-btn {{$vocabulary->isFavorited() ? " fa-star-active": ""}}"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="Избранный"
                    ></i>
                </div>
            </div>
            <p>{!! $vocabulary->body !!}</p>
            <div class="tags-block">
                @foreach($vocabulary->categories as $category)
                    <a href="#">
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
    </div>
@endsection

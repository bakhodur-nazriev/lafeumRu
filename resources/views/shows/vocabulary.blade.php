@extends('layouts.default')

@section('content')
    <div class="row mx-4 mt-4 d-flex justify-content-center">
        <div class="col-md-8 col-lg-6 card-block" style="height: 100%;">
            <div class="col-md-12 d-flex justify-content-between py-0 pr-0 pl-0">
                <div>
                    <span class="mb-1">
                        <i class="fa fa-diamond secondary"></i>
                        <i class="fa fa-diamond secondary"></i>
                        <i class="fa fa-diamond secondary"></i>
                    </span>
                </div>
                <div>
                    <i data-id="{{$vocabulary->id}}"
                       class="fa fa-star favourite-quote-btn {{$vocabulary->isFavorited() ? " fa-star-active": ""}}"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="Избранный"
                    ></i>
                </div>
            </div>
            <div class="col-md-12 pt-0 px-0">{!! $vocabulary->body !!}</div>
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
        <div class="col-md-4 col-lg-3 offset-lg-1 d-flex flex-column">
            @include('layouts.rightSidebarUserBlock')
            @include('layouts.postsSidebarPostsBlock')
        </div>
    </div>
@endsection

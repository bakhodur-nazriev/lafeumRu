@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center mt-3">
            <div class="col-lg-11 card-block" style="height: 100%;">
                <div class="col-md-12 d-flex justify-content-between py-0 px-0">
                    <div class="col-6 p-0 atom-icon-block">
                        <img src="img/icons/atom.png"/>
                        <img src="img/icons/atom.png"/>
                        <img src="img/icons/atom.png"/>
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
        </div>
    </div>
    @include('layouts.right-sidebar.rightSidebar')
@endsection

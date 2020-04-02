@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row card-main-block">
            <div class="col-md-3 col-sm-12">
                <h3>Темы</h3>
                @foreach($categories as $category)
                    <div class="categories-main-name">
                        <a href="#"><b>{{ $category->name }}</b></a>
                    </div>
                    @foreach($category->children as $subCategory)
                        <div><a href="#">{{$subCategory->name}}</a></div>
                    @endforeach
                @endforeach
            </div>

            <div class="col-md">
                <div class="row">
                    @foreach($videos as $video)
                        <div class="col-6">
                            <div class="card">
                                <iframe class="youtube-videos" src="{{$video->link}}" frameborder="0"></iframe>
                                <div class="card-body">
                                    <h5 class="card-title mb-0">{{$video->title}}</h5>
                                    <small class="text-muted">
                                        <a href="#" class="d-block">{{$video->channel->name}}</a>
                                    </small>
                                    @foreach($video->tags as $tag)
                                        <p class="mb-0 mr-1 d-inline-block">
                                            <a href="#"><i class="fa fa-tags mr-1"></i>{{$tag->name}},</a>
                                        </p>
                                    @endforeach
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="fa fa-clock-o mr-1"></i>{{$video->duration}}
                                        <span> мин.</span>
                                    </span>
                                    <button class="btn share-button">Поделиться</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection


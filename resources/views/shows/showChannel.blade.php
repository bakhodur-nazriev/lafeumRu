@extends("layouts.default")

@section("content")
    <div class="container">
        <div class="row card-main-block">
            <div class="col-md-3 col-sm-12">
                <h3>Темы</h3>
                @foreach($categories as $category)
                    <a href="#"><b>{{ $category->name }}</b></a>
                    @foreach($category->children as $subCategory)
                        <div><a href="#">{{$subCategory->name}}</a></div>
                    @endforeach
                @endforeach
            </div>
            <div class="col-md">
                <h3>{{ $channels->name }}</h3>
                <p>{{ $channels->description }}</p>

                <div class="row">
                    @foreach($channels->videos as $video)
                        <div class="col-6">
                            <div class="card">
                                <iframe class="youtube-videos" src="{{$video->link}}" frameborder="0"></iframe>
                                <div class="card-body">
                                    <p class="card-text mb-0">{{$video->title}}</p>
                                    @foreach($video->tags as $tag)
                                        <p class="mb-0 mr-1 d-inline-block">
                                            <a href=""><i class="fa fa-tags mr-1"></i>{{$tag->name}},</a>
                                        </p>
                                    @endforeach
                                </div>
                                <div class="card-footer">
                                    <i class="fa fa-clock-o mr-1"></i>{{$video->duration}}<span> мин.</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

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
            <div class="col-md-3">
                <h3>{{ $channels->name }}</h3>
                <p>{{ $channels->description }}</p>

                @foreach($channels->videos as $video)
                    <div class="card">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6 class="card-title">{{$video->title}}</h6>
                            {{--<p class="card-text">{{}}</p>--}}
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">
                                <i class="fa fa-clock-o mr-1"></i>{{$video->duration}}
                            </small>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
@endsection

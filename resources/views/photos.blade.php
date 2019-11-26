@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5 col-xl-4">
                <span class="authors-main-title">
                    <h3>Фотографии</h3>
                    <p>В данном разделе подборка фотографий на тему жизни и ее красоты.</p>
                </span>
            </div>
        </div>
        <div class="row">
            @foreach ($photos as $photo)
                {{-- <div class="col-md-3">
                    <img src="{{ $photo->image }}" alt="..." class="img-thumbnail">
                </div> --}}
                {{-- <div class="col-sm-6 col-md-6 col-lg-4">
                    <a class="text-decoration-none text-dark" href="{{route('category.show',$photo->id)}}">
                        <div class="card  hoverable border-0 mt-5 shadow-sm" style="ovewflow:visible;">
                            <div class="card-img-wrapper animated">
                                <img src="{{$photo->image}}" class="rounded card-img-top shadow-sm" style=" " alt="{{$category->name}}">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title font-weight-bold" style="min-height:60px;">{{ $category->name }}</h3>
                            </div>
                        </div>
                    </a>
                </div> --}}
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <a class="text-decoration-none text-dark" href="">
                        <div class="card  hoverable border-0 mt-5 shadow-sm" style="ovewflow: visible;">
                            <div class="card-img-wrapper animated">
                                <img src="{{$photo->image}}" class="rounded card-img-top shadow-sm" style=" " alt="...">
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
@endsection

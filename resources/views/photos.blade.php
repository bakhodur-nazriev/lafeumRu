@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span class="authors-main-title">
                    <h3 class="secondary">Фотографии</h3>
                    <p class="mb-0">В данном разделе подборка фотографий на тему жизни и ее красоты.</p>
                </span>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($photos as $photo)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ $photo->path }}" data-fancybox="gallery" class="pa-2">
                        <img src="{{ $photo->path }}" class="card-img-top single-image" alt="">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            <div class="mb-4 mt-5 d-flex">
                {!! $photos->onEachSide(1)->links(); !!}
            </div>
        </div>
    </div>
@endsection

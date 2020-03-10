@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span class="authors-main-title">
                    <h3>Фотографии</h3>
                    <p class="mb-0">В данном разделе подборка фотографий на тему жизни и ее красоты.</p>
                </span>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($photos as $photo)
                <div class="col-md-4">
                    <a href="{{ $photo->image }}" data-fancybox="gallery" class="pa-2">
                        <img src="{{ $photo->image }}" class="card-img-top" alt="">
                    </a>
                </div>
            @endforeach
            <div class="mt-3">
                {!! $photos->links(); !!}
            </div>
        </div>
    </div>
@endsection

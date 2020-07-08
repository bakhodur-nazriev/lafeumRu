@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Фотографии',
        'description' => 'В данном разделе подборка фотографий на тему жизни и ее красоты.'
    ])
@endsection

@section('content')
    <div class="col-lg-12">
        <span class="authors-main-title">
            <h3 class="secondary">Фотографии</h3>
            <p class="mb-0">В данном разделе подборка фотографий на тему жизни и ее красоты.</p>
        </span>
    </div>
    @foreach($photos as $photo)
        <div class="d-flex">
            <div class="col-md-6 col-lg-4">
                <a href="{{ $photo->path }}" data-fancybox="gallery" class="pa-2">
                    <img src="{{ $photo->path }}" class="card-img-top single-image" alt="">
                </a>
            </div>
        </div>
    @endforeach
    <div class="mb-4 mt-5 d-flex">
        {!! $photos->onEachSide(1)->links(); !!}
    </div>
@endsection

@section('right-side-bar')@endsection

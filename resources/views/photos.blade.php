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
        <div class="row mb-3">
                <a href="{{ $photo->image }}" data-fancybox="gallery">
                    <div class="card  hoverable border-0 shadow-sm" style="ovewflow: visible;">
                    <a href="{{ $photo->image }}" data-fancybox="gallery">
                        <div class="card  hoverable border-0 shadow-sm" style="ovewflow: visible;">
                            <div class="card-img-wrapper animated">
                                <img src="{{ $photo->image }}" class="rounded card-img-top shadow-sm" style=" " alt="...">
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mt-6 row d-flex justify-content-center">
            {!! $photos->links(); !!}
        </div>
    </div>
@endsection

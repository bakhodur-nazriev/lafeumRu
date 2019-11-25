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
            <div class="col-md-3">
                <img src="/img/6-712x445.jpg" alt="..." class="img-thumbnail">
            </div>
            <div class="col-md-3">
                <img src="/img/13-712x445.jpg" alt="..." class="img-thumbnail">
            </div>
            <div class="col-md-3">
                <img src="/img/63-712x445.jpg" alt="..." class="img-thumbnail">
            </div>
            <div class="col-md-3">
                <img src="/img/103-712x445.jpg" alt="..." class="img-thumbnail">
            </div>
        </div>
    </div>
@endsection

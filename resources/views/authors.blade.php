@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5 col-xl-4">
                <span class="authors-main-title">
                    <h3>Авторы</h3>
                    <p>Авторы цитат, афоризмов и высказываний, представленных на сайте.</p>
                </span>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Поиск по авторам" aria-label="Поиск по авторам" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                            <span>Поиск</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-3 col-xl-2 authors-links">
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
            </div>
            <div class="col-md-3 col-xl-2 authors-links">
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
            </div>
            <div class="col-md-3 col-xl-2 authors-links">
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
            </div>
            <div class="col-md-3 col-xl-2 authors-links">
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
                <a href="#">Lorem, ipsum dolor.</a>
            </div>
        </div>
    </div>
@endsection

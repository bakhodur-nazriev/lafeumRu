@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="authors-main-title">
                <h3>Области знаний</h3>
                <p>В этой рубрике представлены научные дисциплины, направления мысли и теоретические концепции.</p>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-5">
                    <span class="authors-main-title">
                        <h4>
                            <strong>Ведите термин</strong>
                        </h4>
                    </span>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Поиск по термину" aria-label="Поиск по авторам" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                                <span>Поиск</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-xl-3 offset-xl-1 authors-links">
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                </div>
                <div class="col-md-3 col-xl-3 authors-links">
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                </div>
                <div class="col-md-3 col-xl-3 authors-links">
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                    <a href="#">Lorem, ipsum dolor.</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

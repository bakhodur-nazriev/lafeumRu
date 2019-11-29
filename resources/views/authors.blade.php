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
                    <input type="text" class="form-control"
                        id="searchInput" placeholder="Поиск по авторам"
                        aria-label="Поиск по авторам"
                    >
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">

            @foreach ($authors as $author)
                <div class="col-md-3 col-xl-2 authors-links p-1 elastic">
                    <li class="list-group">
                        <a href="#">{{ $author->name }}</a>
                    </li>
                </div>
            @endforeach

        </div>
    </div>
@endsection

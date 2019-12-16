@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5 col-xl-4">
                <span class="authors-main-title">
                    <h3>Каналы YouTube</h3>
                    <p>Введите название канала</p>
                </span>
                <div class="input-group mb-3">
                    <input type="text" id="" class="form-control" placeholder="Введите название канала" aria-label="Поиск по авторам">
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">

            @foreach ($channels as $channel)
                <div class="col-md-3 col-xl-2 authors-links">
                    <li class="list-group">
                        <a href="#">{{ $channel->name }}</a>
                    </li>
                </div>
            @endforeach

        </div>
    </div>
@endsection

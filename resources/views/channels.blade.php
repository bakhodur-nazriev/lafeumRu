@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5 col-xl-4">
                <span class="authors-main-title">
                    <h3>Каналы YouTube</h3>
                </span>
                <div class="input-group mb-3">
                    <input
                        type="text"
                        id="channels-search"
                        class="form-control"
                        placeholder="Введите название канала"
                    >
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($channels as $channel)
                <div class="col-md-3 channel authors-links">
                    <li class="list-group">
                        <a href="/channels/{{$channel->id}}">{{ $channel->name }}</a>
                    </li>
                </div>
            @endforeach
        </div>
        <script>
            $(document).ready(() => {
                $("#channels-search").keyup((e) => {
                    search(".channel", e.target.value);
                })
            })
        </script>
    </div>
@endsection

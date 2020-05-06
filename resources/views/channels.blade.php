@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-8 col-md-5 col-xl-4">
                <span class="authors-main-title">
                    <h3 class="secondary">YouTube Каналы</h3>
                </span>
                <div class="input-group my-4">
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
                <div class="col-sm-5 offset-sm-1 col-md-2 offset-md-1 channel authors-links">
                    <li class="list-group">
                        <a href="/channels/{{$channel->slug}}">{{ $channel->name }}</a>
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

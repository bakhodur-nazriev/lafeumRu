@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Каналы YouTube',
        'description' => ''
    ])
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-sm-8 col-md-4">
            <span class="authors-main-title">
                <h3 class="secondary">YouTube Каналы</h3>
            </span>
            <div class="input-group">
                <input
                    type="text"
                    id="channels-search"
                    class="form-control"
                    placeholder="Введите название канала"
                >
                <div class="input-group-append">
                    <div class="input-group-text cursor-pointer" id="vocabulary-search-button">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>
            <small id="channels-search-result" class="form-text text-muted ml-1"></small>
        </div>
    </div>
    <div class="row channels">
        @foreach ($channels as $channel)
            <div class="col-lg-3 offset-lg-1 authors-links">
                <li class="list-group">
                    <a class="channels-color" href="/channels/{{$channel->slug}}">{{ $channel->name }}</a>
                </li>
            </div>
        @endforeach
    </div>
    <script>
        $(document).ready(() => {
            attachSearch(
                "#channels-search",
                ".channels",
                '#channels-search-result'
            );
        })
    </script>
@endsection

@section('right-side-bar')@endsection

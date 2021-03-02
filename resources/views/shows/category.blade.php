@extends('layouts.default')

@php
    $title = $category->name . " - ";
    switch ($category->type) {
        case 'App\\Quote':
            $title .= "высказывания и цитаты известных людей";
            break;
        case 'App\\Term':
            $title .= "термины и комментарии специалистов";
            break;
        case 'App\\Video':
            $title .= "видео";
            break;
    }
@endphp

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => $title,
        'description' => $category->description,
        'next' => $category->categoriables->nextPageUrl(),
        'prev' => $category->categoriables->previousPageUrl()
    ])
@endsection


@section('left-side-bar')
    @include('layouts.left-sidebar.leftSidebar', ['type' => $category->type, 'active' => $category->id])
@endsection

@section('content')
    <h3 class="secondary">{{$category->name}}</h3>
    <p>{!!$category->description!!}</p>

    <div class="row">
        @foreach ($category->categoriables as $item)
            @switch($category->type)
                @case('App\\Quote')
                    <div class="col-12 py-0">
                        @include('layouts.quoteItem')
                    </div>
                @break
                @case('App\\Term')
                    <div class="col-12 py-0">
                        @include('layouts.termItem')
                    </div>
                @break
                @case('App\\Video')
                    @include('layouts.videoItem')
                @break
            @endswitch
        @endforeach
    </div>

    <div class="row">
        <div class="col-12">
            <nav aria-label="Page navigation example">
                <div class="row d-flex justify-content-center mt-3">
                    {{ $category->categoriables->links() }}
                </div>
            </nav>
        </div>
    </div>
@endsection

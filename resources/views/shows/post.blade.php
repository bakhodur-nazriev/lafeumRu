@extends('layouts.default')

@php
    $postMetatags = [];

    $postMetatags['article'] = [
        'section' => 'Авторы',
        'published' => $item->created_at->toAtomString(),
        'updated' => $item->updated_at->toAtomString()
    ];

    switch ($post->postable_type) {
        case 'App\\Quote':
            
            $quoteBody = substr(strip_tags($item->body), 0, 60);

            $postMetatags['title'] = "{$item->author->name}: $quoteBody - ЛАФЕЮМ";

            break;
        case 'App\\Term':

            $termBody = substr(strip_tags($item->body), 0, 60);

            $postMetatags['title'] = "$termBody - ЛАФЕЮМ";
            $postMetatags['description'] = substr(
                strip_tags($item->body), 0, 150
            ) . " ...";

            break;
        case 'App\\Video':
            $postMetatags['title'] = $item->title;
            break;
    }
@endphp

@section('meta-tags')
    @include('layouts.meta-tags', $postMetatags)
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6" style="height: 100%;">
            @switch($post->postable_type)
                @case('App\\Quote')
                    @include('layouts.quoteItem')    
                @break
                @case('App\\Term')
                    @include('layouts.termItem')
                @break
                @case('App\\Video')
                    @include('layouts.videoItem')
                @break
            @endswitch
        </div>
    </div>
@endsection

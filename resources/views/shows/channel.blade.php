@extends("layouts.default")

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => $channel->name . ". Цитаты, афоризмы и высказывания.",
        'description' => $channel->description
    ])
@endsection

@section("content")
    <channels-left-sidebar></channels-left-sidebar>
    <channel-show :channel="{{ $channel }}" :channels="{{ $channels }}"></channel-show>
@endsection

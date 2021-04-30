@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', $postMetatags)
@endsection

@section('content')
    <post-show
        :post="{{ $post }}"
        :item="{{ $item }}"
    ></post-show>
@endsection

@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'О сайте',
        'description' => 'Здесь собраны, соответствующие тематике сайта, цитаты и афоризмы,
        термины научного мира и полезные ссылки на познавательно-образовательные каналы YouTube.',
    ])
@endsection

@section('content')
    <about-us></about-us>
@endsection

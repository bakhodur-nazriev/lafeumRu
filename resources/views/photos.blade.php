@extends('layouts.empty')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Фотографии',
        'description' => 'В данном разделе подборка фотографий на тему жизни и ее красоты.'
    ])
@endsection

@section('content')
    <photos></photos>
@endsection

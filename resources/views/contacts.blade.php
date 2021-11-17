@extends('layouts.empty')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Контакты',
        'description' => 'Мы рады, что Вы посетили наш сайт и ознакомились с находящейся на нем информацией.'
    ])
@endsection

@section('content')
    <contacts></contacts>
@endsection


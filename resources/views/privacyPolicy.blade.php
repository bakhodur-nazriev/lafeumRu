@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags',[
        'title' => 'Политика конфиденциальности',
        'description' => 'Пользователь, регистрируясь на интернет-сайте lafeum.ru (далее - Сервис),
        принимает настоящее Согласие на обработку персональных данных.'
    ])
@endsection

@section('content')
    <privacy-policy></privacy-policy>
@endsection

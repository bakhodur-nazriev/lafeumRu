@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Пользовательское соглашение',
        'description' => '',
    ])
@endsection

@section('content')
    <terms-of-use></terms-of-use>
@endsection

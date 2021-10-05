@extends('layouts.empty')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => "Контакты.",
    ])
@endsection

@section('content')
    <contacts></contacts>
@endsection


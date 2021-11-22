@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => isset($category) ? $category->name . ' - словарь': 'Словарь',
        'description' => isset($category) ? $category->description: ''
    ])
@endsection

@section('content')
    @include('layouts.left-sidebar.leftSideBar')
    <vocabulary></vocabulary>
@endsection

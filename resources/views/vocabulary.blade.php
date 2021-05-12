@extends("layouts.default")
@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => isset($category) ? $category->name . ' - словарь': 'Словарь',
        'description' => isset($category) ? $category->description: ''
    ])
@endsection
{{--@section('left-side-bar')--}}
{{--    @include('layouts.left-sidebar.leftSidebar', [--}}
{{--        'type' => 'App\Term',--}}
{{--        'linkPrefix' => 'vocabulary',--}}
{{--        'active' => isset($category) ? $category->id : null--}}
{{--    ])--}}
{{--@endsection--}}
@section("content")
{{--    <left-side-bar :categories="{{ $categories }}"></left-side-bar>--}}
    <vocabulary></vocabulary>
@endsection

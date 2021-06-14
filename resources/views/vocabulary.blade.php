@extends("layouts.default")

{{--@section('meta-tags')--}}
{{--    @include('layouts.meta-tags', [--}}
{{--        'title' => isset($categories) ? $categories->name . ' - словарь': 'Словарь',--}}
{{--        'description' => isset($categories) ? $categories->description: ''--}}
{{--    ])--}}
{{--@endsection--}}

@section("content")
    @include('layouts.left-sidebar.leftSideBar')
    <vocabulary></vocabulary>
@endsection

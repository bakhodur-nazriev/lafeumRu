@extends('layouts.default')

{{--@php--}}
{{--    $title = $category->name . " - ";--}}
{{--    switch ($category->type) {--}}
{{--        case 'App\\Quote':--}}
{{--            $title .= "высказывания и цитаты известных людей";--}}
{{--            break;--}}
{{--        case 'App\\Term':--}}
{{--            $title .= "термины и комментарии специалистов";--}}
{{--            break;--}}
{{--        case 'App\\Video':--}}
{{--            $title .= "видео";--}}
{{--            break;--}}
{{--    }--}}
{{--@endphp--}}

{{--@section('meta-tags')--}}
{{--    @include('layouts.meta-tags', [--}}
{{--        'title' => $title,--}}
{{--        'description' => $category->description,--}}
{{--    ]);--}}
{{--@endsection--}}

@section('content')
    {{--    @include('layouts.left-sidebar.leftSideBar')--}}
    <left-side-bar></left-side-bar>
    <category></category>
@endsection

@extends('layouts.default')

{{--@php--}}
{{--    $title = $categories->name . " - ";--}}
{{--    switch ($categories->type) {--}}
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
{{--        'description' => $categories->description,--}}
{{--    ]);--}}
{{--@endsection--}}

@section('content')
    @include('layouts.left-sidebar.leftSideBar')
    <category></category>
@endsection

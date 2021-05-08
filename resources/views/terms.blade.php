@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Термины',
        'description' => ''
    ])
@endsection

@section('content')
    @include('layouts.left-sidebar.leftSideBar', ['type' => 'App\Term'])

    <terms></terms>
@endsection

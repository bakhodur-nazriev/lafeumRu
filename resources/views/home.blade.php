@extends('layouts.default')

@section('content')
    <home-left-sidebar :categories="{{ $categories }}"></home-left-sidebar>
    <home></home>
@endsection

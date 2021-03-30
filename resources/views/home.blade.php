@extends('layouts.default')

@section('content')
    <left-side-bar :categories="{{ $categories }}"></left-side-bar>
    <home></home>
@endsection

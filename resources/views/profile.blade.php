@extends('layouts.empty')

@section('content')
    <profile :user="{{ Auth::user() }}" :user-role="{{ Auth::user()->role }}"></profile>
@endsection

@extends('layouts.default')

@section('content')
    <quotes :quotes="{{ $quotes }}"></quotes>
@endsection

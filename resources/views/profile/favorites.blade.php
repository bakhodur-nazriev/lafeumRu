@extends('layouts.default-empty')

@section('content')
    <div class="row">
        <div class="col-md-12 my-3">
            <h4 class="title-profile-page">Профиль</h4>
        </div>
    </div>
    <div class="row">
        @include('profile.profile-left-sidebar')
    </div>
@endsection

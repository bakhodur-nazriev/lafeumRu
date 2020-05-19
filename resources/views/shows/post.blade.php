@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row mx-4 mt-4 d-flex justify-content-center">
            <div class="col-lg-12" style="height: 100%;">
                @switch($post->postable_type)
                    @case('App\\Quote')
                    @include('layouts.quoteItem')
                    @break
                    @case('App\\Term')
                    @include('layouts.termItem')
                    @break
                    @case('App\\Video')
                    @include('layouts.videoItem')
                    @break
                @endswitch
            </div>
        </div>
    </div>
    @include('layouts.right-sidebar.rightSidebar')
@endsection

@extends('layouts.default')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6" style="height: 100%;">
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
@endsection

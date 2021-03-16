@extends('layouts.default-empty')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Фотографии',
        'description' => 'В данном разделе подборка фотографий на тему жизни и ее красоты.'
    ])
@endsection

@section('content')
    <photos></photos>

    <!-- <div class="mt-5 d-flex justify-content-center">
        {!! $photos->onEachSide(2)->links(); !!}
    </div> -->
@endsection

@extends('layouts.default')

@section('content')
    <v-container fluid>
        <v-row justify="center">
            <v-col md5 lg4>
                <span class="authors-main-title">
                    <h3>Фотографии</h3>
                    <p>В данном разделе подборка фотографий на тему жизни и ее красоты.</p>
                </span>
            </v-col>
        </v-row>
        <v-row justify="center">
            @foreach($photos as $photo)
                <a href="{{ $photo->image }}" data-fancybox="gallery" class="pa-2">
                    <v-card class="mx-auto" max-width="400">
                        <img src="{{ $photo->image }}" class="rounded card-img-top shadow-sm" alt="">
                    </v-card>
                </a>
            @endforeach
        </v-row>
        <v-row justify="center" class="mt-6">
            {!! $photos->links(); !!}
        </v-row>
    </v-container>
@endsection

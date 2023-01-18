@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'О сайте',
        'description' => 'Здесь собраны, соответствующие тематике сайта, цитаты и афоризмы,
        термины научного мира и полезные ссылки на познавательно-образовательные каналы YouTube.',
    ])
@endsection

@section('content')
    <div>
        <form method="post" action="/quotes/245/favorites">
            {{ csrf_field() }}

            <button type="submit" class="btn btn-primary">OK</button>
        </form>
    </div>

    {{--        <about-us></about-us>--}}
@endsection

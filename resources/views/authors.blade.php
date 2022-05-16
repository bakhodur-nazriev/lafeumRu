@extends("layouts.default")

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Авторы всех цитат и высказываний представленных на сайте',
        'description' => 'Авторы. Полный список всех авторов по алфавиту, а также есть возможность поиска.'
    ])
@endsection

@section("content")
    <authors></authors>
@endsection

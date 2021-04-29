@extends("layouts.default")

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Области знаний',
        'description' => 'В этой рубрике термины и комментарии специалистов классифицированы более развернуто по группам и направлениям.'
    ])
@endsection

@section("content")
    <knowledge-area></knowledge-area>
@endsection

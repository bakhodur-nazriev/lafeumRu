@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Термины',
        'description' => '',
        'next' => $terms->nextPageUrl(),
        'prev' => $terms->previousPageUrl()
    ])
@endsection

@section('left-side-bar')
    @include('layouts.left-sidebar.categories', ['type' => 'App\Term'])
@endsection

@section('content')
    <h3 class="secondary mb-4">Термины</h3>
    @foreach($terms as $term)
        @include('layouts.termItem')
    @endforeach
    @include('layouts.unauthorizeModal')
    <div class="col-12">
        <nav aria-label="Page navigation example">
            <div class="row d-flex justify-content-center mt-3">
                {!! $terms->links(); !!}
            </div>
        </nav>
    </div>
@endsection

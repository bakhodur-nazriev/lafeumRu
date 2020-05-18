@extends('layouts.default')

@section('content')
    @include('layouts.left-sidebar.categories', ['type' => 'App\Term'])
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="secondary mb-4">Термины</h3>
                @foreach($terms as $term)
                    @include('layouts.termItem')
                @endforeach
                <div class="col-12">
                    <nav aria-label="Page navigation example">
                        <div class="row d-flex justify-content-center mt-3">
                            {!! $terms->links(); !!}
                        </div>
                    </nav>
                </div>
            </div>
            <button class="btn btn-primary btnScrollToTop">
                <i class="fa fa-arrow-up"></i>
            </button>
        </div>
    </div>
    @include('layouts.right-sidebar.rightSidebar')
@endsection

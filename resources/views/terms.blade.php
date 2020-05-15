@extends('layouts.default')

@section('content')
    <div class="row card-main-block">
        @include('layouts.categories', ['type' => 'App\Term'])
        <div class="col-md-9 col-xl-10 col-sm-12 d-flex justify-content-around">
            <div class="col-md-7 col-lg-7 ml-5">
                <h3 class="secondary mb-4">Термины</h3>
                @foreach($terms as $term)
                    @include('layouts.termItem')
                @endforeach
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation example">
                            <div class="row d-flex justify-content-center my-6">
                                {!! $terms->links(); !!}
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-3 d-flex flex-column">
                @include('layouts.rightSidebarUserBlock')
                @include('layouts.postsSidebarPostsBlock')
            </div>
        </div>
    </div>
@endsection

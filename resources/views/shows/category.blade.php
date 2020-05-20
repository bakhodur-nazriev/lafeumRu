@extends('layouts.default')

@section('left-side-bar')
    @include('layouts.left-sidebar.categories', ['type' => $category->type, 'active' => $category->id])
@endsection

@section('content')
    <h3 class="secondary">{{$category->name}}</h3>
    <p>{{$category->description}}</p>
    
    @foreach ($category->categoriables as $item)
        @switch($category->type)
            @case('App\\Quote')
                @include('layouts.quoteItem')
            @break
            @case('App\\Term')
                @include('layouts.termItem')
            @break
            @case('App\\Video')
                <div class="row">
                    @include('layouts.videoItem')
                </div> 
            @break
        @endswitch
    @endforeach

    <div class="row">
        <div class="col-12">
            <nav aria-label="Page navigation example">
                <div class="row d-flex justify-content-center mt-3">
                    {{ $category->categoriables->links() }}
                </div>
            </nav>
        </div>
    </div>
@endsection

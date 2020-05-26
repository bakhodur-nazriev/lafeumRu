@extends('layouts.frontApp')

@section('layout')
    @include('layouts.navbar')
    
    <div class="container-fluid">
        <div class="row">
            <div class="left-sidebar-col">@yield('left-side-bar')</div>

            <div class="col">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="right-sidebar-col">@yield('right-side-bar', View::make('layouts.right-sidebar.rightSidebar'))</div>

            <button class="btn btn-primary btnScrollToTop">
                <i class="fa fa-arrow-up"></i>
            </button>
        </div>
    </div>

    @include('layouts.footer')
    <script src="/js/favourite.js"></script>

    
@endsection

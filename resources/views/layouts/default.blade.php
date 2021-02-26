@extends('layouts.frontApp')

@section('layout')
    {{--@include('layouts.navbar')--}}
    <front-navbar></front-navbar>

    <div class="container-fluid flex-grow-1 default-container">
        <div class="row justify-content-center">
            <div class="left-sidebar-col xs-second-order sm-first-order">@yield('left-side-bar')</div>
            <div class="col xs-first-order sm-second-order">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="right-sidebar-col xs-third-order sm-third-order"
            >
                @yield('right-side-bar', View::make('layouts.right-sidebar.rightSidebar'))
            </div>
            <button id="scrollToTopBtn" class="btn btn-primary scrollBtn">
                <i class="fa fa-arrow-up"></i>
            </button>
            <button id="scrollToBottomBtn" class="btn btn-primary scrollBtn">
                <i class="fa fa-arrow-down"></i>
            </button>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6 col-sm-10">
                @yield('bottom-content')
            </div>
        </div>
    </div>

    <front-footer></front-footer>
    {{--    @include('layouts.footer')--}}
    {{--    <script src="/js/favourite.js"></script>--}}

    {{--    <div id="summaryModal" class="card">--}}
    {{--        <div class="content"></div>--}}
    {{--    </div>--}}
    {{--    <script src="/js/summary.js"></script>--}}

@endsection

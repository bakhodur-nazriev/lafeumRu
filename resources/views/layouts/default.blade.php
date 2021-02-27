@extends('layouts.frontApp')

@section('layout')
    {{--@include('layouts.navbar')--}}
    <front-navbar></front-navbar>

    <div class="container-fluid flex-grow-1 default-container">
        <div class="row justify-content-center">
            {{--            <div class="left-sidebar-col xs-second-order sm-first-order">@yield('left-side-bar')</div>--}}
            <left-side-bar></left-side-bar>
<!--            <div class="col-lg-8">
                @yield('content')
            </div>-->
            <right-side-bar></right-side-bar>
            {{--            <button id="scrollToTopBtn" class="btn btn-primary scrollBtn">--}}
            {{--                <i class="fa fa-arrow-up"></i>--}}
            {{--            </button>--}}
            {{--            <button id="scrollToBottomBtn" class="btn btn-primary scrollBtn">--}}
            {{--                <i class="fa fa-arrow-down"></i>--}}
            {{--            </button>--}}
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

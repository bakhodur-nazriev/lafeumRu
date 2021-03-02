@extends('layouts.frontApp')

@section('layout')
    @include('layouts.navbar')

    <div class="container-fluid flex-grow-1 default-container">
        <div class="row justify-content-center">
            <div class="col xs-first-order sm-second-order">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <div id="summaryModal" class="card">
        <div class="content"></div>
    </div>
    <script src="/js/summary.js"></script>
@endsection

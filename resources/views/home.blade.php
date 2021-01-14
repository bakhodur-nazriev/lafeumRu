@extends('layouts.default')

@section('meta-tags')
@include('layouts.meta-tags', [
'fullTitle' => 'ЛАФЕЮМ',
'description' => 'Сайт посвящен самореализации. Здесь собраны, соответствующие тематике цитаты и афоризмы, термины
научного мира и полезные ссылки на познавательные каналы YouTube.'
])
@endsection

@section('content')
<div class="text-center about-us-section">
    <img src="/img/lafeum-main-logo.png" alt="Logo lafeum">
    <p>
        Приветствуем Вас на сайте ЛАФЕЮМ!<br>
        Сайт как научно–образовательный медиаресурс призван<br>
        предоставить доступ к знаниям, раскрывающим потенциал личности.<br>
        Приятного и полезного чтения!
    </p>
</div>
<div>
    <h3 class="secondary text-center">Темы</h3>
    <div class="row main-themes">
        @for($i = 0; $i < 9; $i=$i+3) <div class="col-lg-4 offset-lg-0 col-md-3 offset-md-1 align-top">
            <div class="dropdown">
                <button id="theme-{{ $categories[$i]->slug }}" type="button" data-toggle="dropdown"
                    class="btn btn-link categories-color dropdown-toggle py-0">
                    <span class="lead font-weight-bold">{{ $categories[$i]->name }}</span>
                </button>

                <div class="dropdown-menu py-0">
                    @foreach($categories[$i]->post_links as $postsLink)
                    <a class="dropdown-item home-themes-dropdown"
                        href="{{ $postsLink['href'] }}">{{$postsLink['label']}}</a>
                    <div class="dropdown-divider m-0"></div>
                    @endforeach
                </div>

            </div>
            @foreach($categories[$i]->children as $subCategory)
            <div class="dropdown">
                <button id="theme-{{ $subCategory->slug }}" type="button" data-toggle="dropdown"
                    class="btn btn-link categories-color dropdown-toggle py-0">
                    {{ $subCategory->name }}
                </button>
                <div class="dropdown-menu py-0">
                    @foreach($subCategory->post_links as $postsLink)
                    <a class="dropdown-item home-themes-dropdown"
                        href="{{ $postsLink['href'] }}">{{$postsLink['label']}}</a>
                    <div class="dropdown-divider m-0"></div>
                    @endforeach
                </div>
            </div>
            @endforeach

            @if($i === 6)
            <div class="dropdown" style="margin-top: 20px">
                <button id="theme-{{ $categories[$i+3]->slug }}" type="button" data-toggle="dropdown"
                    class="btn btn-link categories-color dropdown-toggle py-0">
                    <span class="lead font-weight-bold">{{ $categories[$i+3]->name }}</span>
                </button>

                <div class="dropdown-menu py-0">
                    @foreach($categories[$i+3]->post_links as $postsLink)
                    <a class="dropdown-item home-themes-dropdown"
                        href="{{ $postsLink['href'] }}">{{$postsLink['label']}}</a>
                    <div class="dropdown-divider m-0"></div>
                    @endforeach
                </div>
            </div>
            @foreach($categories[$i+3]->children as $subCategory)
            <div class="dropdown">
                <button id="theme-{{ $subCategory->slug }}" type="button" data-toggle="dropdown"
                    class="btn btn-link categories-color dropdown-toggle py-0">
                    {{ $subCategory->name }}
                </button>
                <div class="dropdown-menu py-0">
                    @foreach($subCategory->post_links as $postsLink)
                    <a class="dropdown-item home-themes-dropdown"
                        href="{{ $postsLink['href'] }}">{{$postsLink['label']}}</a>
                    <div class="dropdown-divider m-0"></div>
                    @endforeach
                </div>
            </div>
            @endforeach
            @php $i = $i+3; @endphp
            @endif
    </div>
    @endfor
</div>
</div>
@endsection

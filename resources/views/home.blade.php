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
        <div class="col-lg-1 offset-lg-3 col-md-3 offset-md-1 align-top">
            <div class="dropdown">
                <button id="theme-{{ $categories[0]->slug }}" type="button" data-toggle="dropdown"
                    class="btn btn-link categories-color dropdown-toggle py-0">
                    <span class="lead font-weight-bold">{{ $categories[0]->name }}</span>
                </button>

                <div class="dropdown-menu py-0">
                    @foreach($categories[0]->post_links as $postsLink)
                    <a class="dropdown-item home-themes-dropdown"
                        href="{{ $postsLink['href'] }}">{{$postsLink['label']}}</a>
                    <div class="dropdown-divider m-0"></div>
                    @endforeach
                </div>

            </div>
            @foreach($categories[0]->children as $subCategory)
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
        </div>
        <div class="col-lg-1 offset-lg-3 col-md-3 offset-md-1 align-top">
            @for($i = 1; $i < $categories->count(); $i++)
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
                @foreach($categories[$i]->children as $index=>$subCategory)
                <div class="dropdown @php echo ($index == count($categories[$i]->children) - 1) ? " mb-3" : "" @endphp">
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
            @endfor
        </div>
    </div>
</div>
@endsection

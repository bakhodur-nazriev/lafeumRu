@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'fullTitle' => 'ЛАФЕЮМ',
        'description' => 'Сайт посвящен самореализации. Здесь собраны, соответствующие тематике цитаты и афоризмы, термины научного мира и полезные ссылки на познавательные каналы YouTube.'
    ])
@endsection

@section('content')
    <div class="container">
        <div class="row justify-center">
            <div class="col-lg-12">
                <div class="text-center about-us-section">
                    <h3 class="secondary">О Сайте</h3>
                    <img src="/img/lafeum-main-logo.png" alt="Logo lafeum">
                    <p>Информированность о методах развития личности и совершенствования профессиональных знаний,
                        С этой целью и создан данный ресурс, который посвящен самореализации. Здесь собраны,
                        соответствующие
                        тематике сайта,
                        цитаты и афоризмы, термины научного мира и полезные ссылки на познавательно-образовательные
                        каналы
                        YouTube.
                        Для удобства навигации и чтения, темы сайта разделены на четыре взаимосвязанные группы.
                        Основным источником терминов (более 98%) является Википедия. В каждом термине есть ссылка на
                        этот
                        популярный ресурс,
                        где вы можете более детально получить желаемую информацию. Комментарии и мысли специалистов
                        взяты с
                        популярных сайтов,
                        на которые также указаны источники для подробного чтения.<br>
                        Приятного и полезного чтения!</p>
                </div>
                <div>
                    <h3 class="secondary text-center">Темы</h3>
                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-lg-3 align-top mb-3">
                                <div class="dropdown dd-main-page">
                                    <button class="btn btn-default dropdown-toggle dd-themes-main-page-name"
                                            type="button"
                                            id="menu1"
                                            data-toggle="dropdown">
                                        <div class="categories-main-name">
                                            <a href="#"><b>{{ $category->name }}</b></a>
                                        </div>
                                        <span class="caret"></span></button>
                                    <ul
                                        class="dropdown-menu dd-menu-main-page"
                                        role="menu" aria-labelledby="menu1">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1"
                                               href="/quotes/{{ $category->slug }}">Цитаты</a>
                                        </li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1"
                                               href="/videos/{{ $category->slug }}">Видео</a>
                                        </li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1"
                                               href="/terms/{{ $category->slug }}">Термин</a>
                                        </li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1"
                                               href="/vocabulary/{{ $category->slug }}">Словарь</a>
                                        </li>
                                    </ul>
                                </div>
                                @foreach($category->children as $subCategory)
                                    <div class="dropdown dd-main-page">
                                        <button class="btn btn-default dropdown-toggle dd-themes-main-page-subname"
                                                type="button"
                                                id="menu1"
                                                data-toggle="dropdown">
                                            <div class="categories-main-subname">
                                                <a href="#">{{ $subCategory->name }}</a>
                                            </div>
                                            <span class="caret"></span></button>
                                        <ul
                                            class="dropdown-menu dd-submenu-main-page"
                                            role="menu"
                                            aria-labelledby="menu1"
                                        >
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1"
                                                   href="/quotes/{{ $subCategory->slug }}">Цитаты</a>
                                            </li>
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1"
                                                   href="/videos/{{ $subCategory->slug }}">Видео</a>
                                            </li>
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1"
                                                   href="/terms/{{ $subCategory->slug }}">Термин</a>
                                            </li>
                                            <li role="presentation" class="divider text-center"></li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1"
                                                   href="/vocabulary/{{ $subCategory->slug }}">Словарь</a></li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-content')
    @include('layouts.countItems')
@endsection

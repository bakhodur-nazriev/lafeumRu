@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'fullTitle' => 'ЛАФЕЮМ',
        'description' => 'Сайт посвящен самореализации. Здесь собраны, соответствующие тематике цитаты и афоризмы, термины научного мира и полезные ссылки на познавательные каналы YouTube.'
    ])
@endsection

@section('content')
    <div class="text-center about-us-section">
        <h3 class="secondary">О Сайте</h3>
        <img src="/img/lafeum-main-logo.png" alt="Logo lafeum">
        <p>
            Информированность о методах развития личности и совершенствования профессиональных знаний,
            осведомленность в вопросах бытия и научно-популярных тем вместе взятых, без сомнения,
            способствуют повышению образованности и компетентности, расширению мировоззрения,
            которые в свою очередь играют определяющую роль в постановке и достижении целей,
            в реализации нашего личностного потенциала. Именно поэтому в современном мире для
            ищущих знаний важна элементарность и доступность информации.
            Следовательно, вопрос распространения знаний и популяризации науки на сегодня один из самых важных.
        </p>
        <p>
            С этой целью и создан данный ресурс. Здесь собраны, соответствующие тематике сайта, цитаты и афоризмы,
            термины научного мира и полезные ссылки на познавательно-образовательные каналы YouTube.
            Для удобства навигации и чтения, темы сайта разделены на три взаимосвязанные группы.
        </p>
        <p>
            Основным источником терминов является Википедия. В каждом термине есть ссылка на этот популярный ресурс,
            где вы можете более детально получить желаемую информацию. Комментарии и мысли специалистов взяты с
            популярных сайтов, на которые также указаны источники для подробного чтения.
        </p>
        <p>Приятного и полезного чтения!</p>
    </div>
    <div>
        <h3 class="secondary text-center">Темы</h3>
        <div class="row main-themes">
            @foreach($categories as $category)
                <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 align-top">

                    <div class="dropdown">
                        <button
                            id="theme-{{ $category->slug }}"
                            type="button"
                            data-toggle="dropdown"
                            class="btn btn-link categories-color dropdown-toggle py-1"
                        >
                            <span class="lead font-weight-bold">{{ $category->name }}</span>
                        </button>

                        <div class="dropdown-menu">
                            @foreach($category->post_links as $postsLink)
                                <a class="dropdown-item" href="{{ $postsLink['href'] }}">{{$postsLink['label']}}</a>
                                <div class="dropdown-divider"></div>
                            @endforeach
                        </div>

                    </div>
                    @foreach($category->children as $subCategory)
                        <div class="dropdown">
                            <button
                                id="theme-{{ $subCategory->slug }}"
                                type="button"
                                data-toggle="dropdown"
                                class="btn btn-link categories-color dropdown-toggle py-1"
                            >
                                {{ $subCategory->name }}
                            </button>
                            <div class="dropdown-menu">
                                @foreach($subCategory->post_links as $postsLink)
                                    <a class="dropdown-item" href="{{ $postsLink['href'] }}">{{$postsLink['label']}}</a>
                                    <div class="dropdown-divider"></div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection

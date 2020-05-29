@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'ЛАФЕЮМ',
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
                            <div class="categories-main-name">
                                <a href="#"><b>{{ $category->name }}</b></a>
                            </div>
                            @foreach($category->children as $subCategory)
                            <div class="subcategories-block">
                                <a href="#">{{$subCategory->name}}</a><br>
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
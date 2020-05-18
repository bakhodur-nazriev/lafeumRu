@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-center">
            <div class="col-lg-12">
                <div class="col text-center about-us-section">
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
                <div class="col-md-12 col-xl-12">
                    <h3 class="secondary text-center">Темы</h3>
                </div>
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
            <div class="row">
                <div class="col-md-12">
                    <h3 class="secondary text-center">Фото</h3>
                </div>
                @foreach ($photos as $photo)
                    <div id="carouselExampleControls" class="carousel slide my-2 d-inline-block col-md-4">
                        <div class="carousel-inner main-page-carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ $photo->path }}" class="d-inline-block" alt="{{ $photo->description }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row my-4">
                <div class="col text-center text-uppercase">
                    <div class="px-4 py-3" style="background-color: #04718c; color: white">посетителей</div>
                    <div class="px-4 py-3" style="background-color: #e0e0e0; font-size: 24px; font-weight: bold;">150
                    </div>
                </div>
                <div class="col text-center text-uppercase">
                    <div class="px-4 py-3" style="background-color: #04718c; color: white">стран</div>
                    <div class="px-4 py-3" style="background-color: #e0e0e0; font-size: 24px; font-weight: bold;">50
                    </div>
                </div>
                <div class="col text-center text-uppercase">
                    <div class="px-4 py-3" style="background-color: #04718c; color: white">цитат</div>
                    <div class="px-4 py-3"
                         style="background-color: #e0e0e0; font-size: 24px; font-weight: bold;">{{$countOfFavoritesQuotes}}</div>
                </div>
                <div class="col text-center text-uppercase">
                    <div class="px-4 py-3" style="background-color: #04718c; color: white">авторов</div>
                    <div class="px-4 py-3"
                         style="background-color: #e0e0e0; font-size: 24px; font-weight: bold;">{{$countOfAuthors}}
                    </div>
                </div>
                <div class="col text-center text-uppercase">
                    <div class="px-4 py-3" style="background-color: #04718c; color: white">терминов</div>
                    <div class="px-4 py-3"
                         style="background-color: #e0e0e0; font-size: 24px; font-weight: bold;">{{$countOfFavoritesTerms}}
                    </div>
                </div>
                <div class="col text-center text-uppercase">
                    <div class="px-4 py-3" style="background-color: #04718c; color: white">медиаконтент</div>
                    <div class="px-4 py-3"
                         style="background-color: #e0e0e0; font-size: 24px; font-weight: bold;">{{ $countOfMediaContent }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.right-sidebar.rightSidebar')
@endsection

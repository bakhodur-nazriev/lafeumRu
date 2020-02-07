@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col text-center about-us-section">
                <h3>О Сайте</h3>
                {{--<img src="/img/lafeum-main-logo.png" alt="Logo lafeum">--}}
                <p>Информированность о методах развития личности и совершенствования профессиональных знаний,
                    С этой целью и создан данный ресурс, который посвящен самореализации. Здесь собраны, соответствующие
                    тематике сайта,
                    цитаты и афоризмы, термины научного мира и полезные ссылки на познавательно-образовательные каналы
                    YouTube.
                    Для удобства навигации и чтения, темы сайта разделены на четыре взаимосвязанные группы.
                    Основным источником терминов (более 98%) является Википедия. В каждом термине есть ссылка на этот
                    популярный ресурс,
                    где вы можете более детально получить желаемую информацию. Комментарии и мысли специалистов взяты с
                    популярных сайтов,
                    на которые также указаны источники для подробного чтения.<br>
                    Приятного и полезного чтения!</p>
            </div>
        </div>
        <div class="row justify-center">
            <div class="col-md-3 col-xl-2 text-left ">
                <h3 class="text-center">Темы</h3>
                @foreach($categories as $category)
                    <div class="mb-5">
                        <a href="/"><b>{{ $category->name }}</b></a>
                        <br>
                        @foreach($category->children as $subCategory)
                            <div>
                                <a href="/">{{$subCategory->name}}</a>
                                <br>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3 class="text-center">Фото</h3>

                <div id="carouselExampleControls" class="carousel slide my-4">
                    <div class="carousel-inner main-page-carousel-inner">
                        <div class="carousel-item active">
                            @foreach ($photos as $photo)
                                <img src="{{ $photo->image }}" class="d-inline-block" alt="">
                            @endforeach
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

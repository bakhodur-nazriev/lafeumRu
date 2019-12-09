@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h3>Темы</h3>
            <a href="">фывафыва</a>
        </div>
        <div class="col-md-9 col-xl-6">
            <h3>Цитаты и Афоризмы</h3>
            <p>Красивые цитаты и афоризмы великих людей, жизненные со смыслом высказывания известнейших поэтов, 
                писателей и философов. Понятия и суждения компетентных ученых и специалистов.
            </p>
            <div class="quotes-blocks">
                <a href="#">
                    <img src="/img/person-60.png" alt="" class="qouter-authors-image">Марк Туллий Цицерон
                </a>
                <p>Мысль о том, что обо мне будут говорить потомки, дает некоторую надежду на бессмертие.</p>

                <a href="#">
                    <img src="/img/tag.png" alt="" class="qouter-authors-image">Мировоззрение
                </a>
                <div class="dropdown-divider"></div>
                <button class="btn qouter-share">Поделиться</button>
            </div>
            <div class="row">
                <div class="col-12">
                    <nav aria-label="Page navigation example">
                        <div class="row d-flex justify-content-center my-6">
                            {{-- {!! $quotes->links(); !!} --}}
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

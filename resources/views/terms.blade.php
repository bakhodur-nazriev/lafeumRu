@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h3>Темы</h3>
            <a href="">фывафыва</a>
        </div>
        <div class="col-md-9 col-xl-6">
            <h3>Термины</h3>
            {{-- <p>Красивые цитаты и афоризмы великих людей, жизненные со смыслом высказывания известнейших поэтов, писателей и философов. Понятия и суждения компетентных ученых и специалистов.</p> --}}
            <div class="quotes-blocks">
                <p>
                    <a href="#">Факторы производства</a> — экономические ресурсы, необходимые для производства товаров и услуг.
                    Традиционно выделяют следующие факторы производства: земля (земельные ресурсы и природные ресурсы);
                    труд (трудовые ресурсы); капитал (финансовые ресурсы). Также в настоящее время к ним традиционно добавляют:
                    предпринимательская способность (предпринимательство); информация (информационные ресурсы).
                    <a href="#">Категория в Википедии.</a>
                </p>

                <div class="tags">
                    <a href="#">
                        <img src="/img/tag.png" alt="" class="qouter-authors-image"> Общество и Будущее,
                    </a>
                    <a href="#">
                        <img src="/img/tag.png" alt="" class="qouter-authors-image"> Предпринимательство,
                    </a>
                    <a href="#">
                        <img src="/img/tag.png" alt="" class="qouter-authors-image"> Экономика и Политика,
                    </a>
                </div>

                <div class="dropdown-divider"></div>
                <button class="btn qouter-share">Поделиться</button>
            </div>
            <div class="row">
                <div class="col-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination quotes-pagiination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends("layouts.default")

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Области знаний',
        'description' => 'В этой рубрике термины и комментарии специалистов классифицированы более развернуто по группам и направлениям.'
    ])
@endsection

@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="authors-main-title">
                <h3 class="secondary">Области знаний</h3>
                <p>В этой рубрике представлены научные дисциплины, направления мысли и теоретические концепции.</p>
            </div>
            <div class="d-flex justify-content-center mt-0 mb-4">
                <div class="col-md-4">
                    <div class="input-group">
                        <input
                            type="string"
                            id="knowledge-area-search"
                            class="form-control"
                            placeholder="Поиск"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text cursor-pointer" id="vocabulary-search-button">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <small id="knowledge-search-result" class="form-text text-muted ml-1"></small>
                </div>
            </div>
            <ul class="list-inline py-1 list-of-knowledge">
                @foreach ($knowledgeAreas as $knowledgeAreaParent)
                    <h5 class="knowledge-parent secondary">
                        {{$knowledgeAreaParent->name}}
                    </h5>
                    
                    @foreach ($knowledgeAreaParent->children as $knowledgeArea)
                        <li class="knowledge">
                            <a href="/knowledge/{{$knowledgeArea->slug}}">{{$knowledgeArea->name}}</a>
                        </li>
                    @endforeach

                @endforeach
            </ul>
            <script>
                $(document).ready(() => {
                    attachSearch(
                        "#knowledge-area-search", 
                        ".list-of-knowledge", 
                        "#knowledge-search-result",
                        ".knowledge-parent"
                    );
                })
            </script>
        </div>
    </div>
@endsection

@section('right-side-bar')@endsection
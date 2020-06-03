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
                    <div class="form-group">
                        <input
                            type="text"
                            id="knowledge-area-search"
                            class="form-control"
                            placeholder="Поиск по области знаний"
                        >
                        <small id="knowledge-search-result" class="form-text text-muted ml-1"></small>
                    </div>
                </div>
            </div>
            <ul class="list-inline py-1 list-of-knowledge">
                @foreach ($knowledgeAreas as $knowledgeArea)
                    <li class="knowledge">
                        <a href="/knowledge/{{$knowledgeArea->slug}}">{{$knowledgeArea->name}}</a>
                    </li>
                @endforeach
            </ul>
            <script>
                $(document).ready(() => {
                    attachSearch(
                        "#knowledge-area-search", 
                        ".list-of-knowledge", 
                        '#knowledge-search-result'
                    );
                })
            </script>
        </div>
    </div>
@endsection

@section('right-side-bar')@endsection
@extends("layouts.default")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="authors-main-title">
                    <h3 class="secondary">Области знаний</h3>
                    <p>В этой рубрике представлены научные дисциплины, направления мысли и теоретические концепции.</p>
                </div>
                <div class="row d-flex justify-content-center mt-0 mb-4">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input
                                type="text"
                                id="knowledge-area-search"
                                class="form-control"
                                placeholder="Поиск по области знаний"
                            >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <ul class="list-inline py-1 list-of-knowledge">
                        @foreach ($knowledgeAreas as $knowledgeArea)
                            <li class="knowledge">
                                <a href="/knowledge/{{$knowledgeArea->slug}}">{{$knowledgeArea->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <script>
                    $(document).ready(() => {
                        $("#knowledge-area-search").keyup((e) => {
                            search(".list-of-knowledge", e.target.value);
                        })
                    })
                </script>
            </div>
        </div>
    </div>
@endsection

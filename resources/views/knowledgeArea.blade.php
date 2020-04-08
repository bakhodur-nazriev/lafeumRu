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
                    @foreach ($knowledgeAreas as $knowledgeArea)
                        <div class="col-md-3 col-xl-3 knowledge authors-links">
                            <a href="/knowledges/{{$knowledgeArea->id}}">{{$knowledgeArea->name}}</a>
                        </div>
                    @endforeach
                </div>
                <script>
                    $(document).ready(() => {
                        $("#knowledge-area-search").keyup((e) => {
                            search(".knowledge", e.target.value);
                        })
                    })
                </script>
            </div>
        </div>
    </div>
@endsection

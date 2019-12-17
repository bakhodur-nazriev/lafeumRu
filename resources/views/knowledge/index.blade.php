@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="authors-main-title">
                <h3>Области знаний</h3>
                <p>В этой рубрике представлены научные дисциплины, направления мысли и теоретические концепции.</p>
            </div>
            <div class="row d-flex justify-content-center mt-0 mb-4">
                <div class="col-md-4">
                    <span class="authors-main-title">
                        <h4>
                            <strong>Ведите термин</strong>
                        </h4>
                    </span>
                    <div class="input-group">
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Поиск по области знаний"
                            aria-label="Поиск по области знаний"
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($knowledges as $knowledge)    
                    <div class="col-md-3 col-xl-2 authors-links">
                        <a href="#">{{ $knowledge->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

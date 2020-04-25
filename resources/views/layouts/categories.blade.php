<div class="col-md-3 col-xl-3 col-sm-12">
    <div style="background-color: white; max-width: 280px; padding: 15px; border-radius: 5px">
        <h3 class="secondary">Темы</h3>
        @foreach($categories as $category)
            <div class="categories-main-name">
                <a href="#"><b>{{ $category->name }}</b></a>
            </div>
            @foreach($category->children as $subCategory)
                <div><a href="#">{{$subCategory->name}}</a></div>
            @endforeach
        @endforeach
    </div>
</div>

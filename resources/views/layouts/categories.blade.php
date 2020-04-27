<div class="col-md-3 col-xl-3 col-sm-12 p-0">
    <div class="left-sidebar-block">
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

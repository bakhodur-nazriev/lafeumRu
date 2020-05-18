<div class="left-sidebar-block">
    <h3 class="secondary">Темы</h3>
    @foreach($categories as $category)
        <div class="categories-main-name">
            <a
                class="{{$category->active ? 'active': ''}}"
                href="{{ $category->link }}"
            >
                <b>{{ $category->name }}</b>
            </a>
        </div>
        @foreach($category->children as $subCategory)
            <div>
                <a
                    class="{{$subCategory->active ? 'active': ''}}"
                    href="{{ $subCategory->link }}"
                >
                    {{$subCategory->name}}
                </a>
            </div>
        @endforeach
    @endforeach
</div>

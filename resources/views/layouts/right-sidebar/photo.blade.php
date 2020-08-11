<div class="right-sidebar-block my-4">
    <a href="{{$dailyPosts->photo->path}}" data-fancybox="gallery">
        <div class="title-of-right-sidebar-posts">
            <h5 class="pl-3 py-2 mb-0">Фото дня</h5>
        </div>
        <div class="p-3">
            <img src="{{ $dailyPosts->photo->path }}" alt="{{$dailyPosts->photo->description}}"
                 style="width: 100%;">
        </div>
    </a>
</div>

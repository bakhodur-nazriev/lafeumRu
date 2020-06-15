<div class="right-sidebar-block my-4">
    <div class="title-of-right-sidebar-posts">
        <h5 class="pl-3 py-2 mb-0">Видео дня</h5>
    </div>
    <div class="p-3">
        <iframe class="youtube-videos p-0" style="width: 100%" src="{{ $dailyPosts['video']->embeded_link }}" frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen="">
        </iframe>
    </div>
</div>

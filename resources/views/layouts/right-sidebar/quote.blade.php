<div class="right-sidebar-block my-2">
    <div class="title-of-right-sidebar-posts">
        <h5 class="pl-3 py-2 mb-0">Цитата дня</h5>
    </div>
    <div class="p-3">
        <p class="mb-1 five-line-truncate">{!! $dailyPosts['quote']->body !!}</p>
        <p class="text-right font-italic m-0">{{ $dailyPosts['quote']['author']->name }}</p>
    </div>
</div>

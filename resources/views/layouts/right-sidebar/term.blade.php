<div class="right-sidebar-block my-4">
    <a href="/{{$dailyPosts->term->post->id}}" target="_blank">
        <div class="title-of-right-sidebar-posts">
            <h5 class="pl-3 py-2 mb-0">Термин дня</h5>
        </div>
    </a>
    <div class="p-3 summary-links-wrapper five-line-truncate">
        <p class="m-0 five-line-truncate">
            {!! $dailyPosts->term->body !!}
        </p>
    </div>
</div>

<div class="right-sidebar-block my-4">
    <div class="title-of-right-sidebar-posts">
        <h5 class="pl-3 py-2 mb-0">Цитата дня</h5>
    </div>
    {{--<div class="p-3">{!! $postsData['quote']->body !!}</div>--}}
    {{--@foreach($dailyQuote->quote_id as $dailyQ)--}}
    @foreach($dailyPost as $dailyP)
        <div>{{ $dailyP->quote_id }}</div>
    @endforeach
    {{--@endforeach--}}
</div>

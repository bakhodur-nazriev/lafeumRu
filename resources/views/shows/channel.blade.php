@extends("layouts.default")

@section("content")
    <div class="row card-main-block">
        <div class="col-md-3 col-lg-2 col-sm-12 left-sidebar-block">
            <h3 class="secondary">Каналы YouTube</h3>
            <div class="mb-3">
                <p class="p-1 mb-0">Введите название канала</p>
                <input
                    type="text"
                    class="form-control"
                    placeholder=""
                    aria-label=""
                    aria-describedby="button-addon1"
                >
            </div>
            @foreach($channels as $channelItem)
                <a href="/channels/{{$channelItem->slug}}">
                    {{ $channelItem->name }}
                </a><br>
            @endforeach
        </div>

        <div class="col-sm-12 col-md-10 col-lg-10 d-flex justify-content-center">
            <div class="col-md-7 col-lg-9 d-flex flex-wrap justify-content-center">
                <div class="col-lg-10">
                    <h3 class="secondary">{{ $channel->name }}</h3>
                    <span>{{ $channel->description }}</span>
                </div>
                @foreach($channel->videos as $video)
                    @include('layouts.videoItem')
                @endforeach
            </div>
            <div class="col-md-12 col-lg-3 d-flex flex-column">
                @include('layouts.rightSidebarUserBlock')
                @include('layouts.postsSidebarPostsBlock')
            </div>
        </div>
    </div>
@endsection

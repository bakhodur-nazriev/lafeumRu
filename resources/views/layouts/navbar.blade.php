<nav class="navbar navbar-expand-lg navbar-light main-navbar fixed-top">
    <!-- Right Side Of Navbar -->
    @include('layouts.smallNavBar')

    <!-- Left side of navbar -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-links align-items-center small-nav-display">
            @php
                $links = [
                    ['href' => '/', 'imageUrl' => '/img/lafeum-ru-home.png'],
                    ['href' => '/knowledge', 'name' => 'Области Знаний'],
                    ['href' => '/vocabulary', 'name' => 'Словарь'],
                    ['href' => '/quotes', 'name' => 'Цитаты'],
                    ['href' => '/authors', 'name' => 'Авторы'],
                    ['href' => '/videos', 'name' => 'Видео'],
                    ['href' => '/channels', 'name' => 'Каналы'],
                    ['href' => '/terms', 'name' => 'Термины'],
                    ['href' => '/photo', 'name' => 'Фотографии'],
                ];
            @endphp
            @foreach($links as $link)
                <li class="nav-item active">
                    <a class="nav-link text-light" href="{{ $link['href'] }}">
                        @if(array_key_exists('name', $link))
                            {{ $link['name'] }}
                        @else
                            <img style="width: 60px" src="{{ $link['imageUrl'] }}">
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
<script>
    $(document).ready(function () {
        $("#loginBtn").click(function () {
            $("#loginModal").modal();
        });
    });
</script>

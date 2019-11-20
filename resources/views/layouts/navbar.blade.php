<nav class="navbar navbar-expand-md navbar-light shadow-sm main-navbar">
    <div class="menu-toggle-btn">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            <li>
                <a class="nav-link text-light text-center" href="{{ url('/') }}">
                    <h2 class="m-0">Добро пожаловать на <br> Lafeum.org</h2>
                </a>
            </li>
        </ul>

        <!-- Center of Navbar -->
        <ul class="nav justify-content-center navbar-links">
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/') }}">Главная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/quotes') }}">Цитаты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/authors') }}">Авторы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/terms') }}">Термины</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/vocabulary') }}">Словарь</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/knowledge-areas') }}">Области Знаний</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/videos') }}">Видео</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/channels') }}">Каналы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/photo') }}">Фотографии</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/contacts') }}">Контакты</a>
            </li>
        </ul>


        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item " href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>

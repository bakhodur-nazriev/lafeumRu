<nav class="navbar navbar-expand-md navbar-light shadow-sm main-navbar sticky-top py-4">
    <div class="menu-toggle-btn navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <!-- Right Side Of Navbar -->
    <div>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Вход') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Регистарция') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}<span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-0 rounded-0" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item py-2" href="{{route('dashboard')}}">{{ __('Личный Кабинет') }}</a>
                        <a class="dropdown-item py-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            {{ __('Выход') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
    <!-- Left of Navbar -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-links small-nav-display">
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/') }}">Главная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/quotes') }}">Цитаты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/author') }}">Авторы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/terms') }}">Термины</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/vocabulary') }}">Словарь</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ url('/knowledge') }}">Области Знаний</a>
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
    </div>
</nav>

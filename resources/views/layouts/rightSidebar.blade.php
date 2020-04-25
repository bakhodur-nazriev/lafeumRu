<div class="col-md-3 col-xl-3 right-block-sidebar">
    <div class="mb-0 card-block" style="width: 280px">
        @guest
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-0 form-group row">
                    <div class="col-md-12">
                        <input
                            id="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                            placeholder="Логин"
                        >
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-0 form-group row">
                    <div class="col-md-12">
                        <input
                            id="password"
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Пароль"
                        >
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn" style="background-color: #04718c; color: white; width: 100%;">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
            </form>
        @endguest
        @auth
            <ul class="list-group">
                <a href="#">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Цитаты
                        <span class="badge background-primary badge-pill">{{ $countOfFavoritesQuotes }}</span>
                    </li>
                </a>
                <a href="#">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Термины
                        <span class="badge background-primary badge-pill">{{ $countOfFavoritesTerms }}</span>
                    </li>
                </a>
                <a href="#">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Видео
                        <span class="badge background-primary badge-pill">{{ $countOfFavoritesVideos }}</span>
                    </li>
                </a>
            </ul>
        @endauth
    </div>
</div>

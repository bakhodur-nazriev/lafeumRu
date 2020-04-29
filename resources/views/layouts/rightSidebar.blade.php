<div class="col-md-3 col-xl-3 d-flex justify-content-center">
    <div class="right-block-sidebar">
        @guest
            <form style="width: 100%;" method="POST" action="{{ route('login') }}">
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
                            {{ __('Вход') }}
                        </button>
                    </div>
                </div>
            </form>
        @endguest
        @auth
            <ul class="list-group" style="width: 300px;">
                <div class="p-0 mb-3">
                    <img src="{{ Auth::user()->avatar }}" style="max-width: 50px;" class="float-left"
                    alt="...">
                    <span class="text-center">{{ Auth::user()->name }}</span>
                    <span>{{ Auth::user()->role }}</span>
                </div>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="#" class="text-decoration-none">Цитаты</a>
                    <span class="badge background-primary badge-pill">{{ $countOfFavoritesQuotes }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="#" class="text-decoration-none">Термины</a>
                    <span class="badge background-primary badge-pill">{{ $countOfFavoritesTerms }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="#" class="text-decoration-none">Видео</a>
                    <span class="badge background-primary badge-pill">{{ $countOfFavoritesVideos }}</span>
                </li>
            </ul>
        @endauth
    </div>
</div>

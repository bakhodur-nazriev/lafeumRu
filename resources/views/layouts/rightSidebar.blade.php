<div class="col-md-3 col-xl-3  d-flex justify-content-end">
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
                <div class="right-sidebar-image-block">
                    <img src="{{ Auth::user()->avatar }}" class="float-left right-sidebar-image" alt="">
                </div>
                <div class="p-0 mb-3">
                    <span>Имя: {{ Auth::user()->name }}</span><br>
                    <span>Email: {{ Auth::user()->email }}</span><br>
                    <span>Вы вошли как: {{ Auth::user()->roles[0]->role }}</span><br>
                </div>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="#" class="text-decoration-none">Цитаты</a>
                    <span class="badge background-primary badge-pill">{{ $favouriteCount['quote'] }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="#" class="text-decoration-none">Термины</a>
                    <span class="badge background-primary badge-pill">{{ $favouriteCount['term'] }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="#" class="text-decoration-none">Видео</a>
                    <span class="badge background-primary badge-pill">{{ $favouriteCount['video'] }}</span>
                </li>
            </ul>
        @endauth
    </div>
</div>

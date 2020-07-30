<div
    tabindex="-1"
    role="dialog"
    id="loginModal"
    aria-hidden="true"
    aria-labelledby="loginModalLabel"
    class="modal fade px-3 rounded overflow-hidden"
>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item w-50" role="presentation">
                    <a
                        class="nav-link login-nav-link h5 text-center m-0 py-3"
                        id="pills-login-tab"
                        data-toggle="pill"
                        href="#pills-login"
                        role="tab"
                        aria-controls="pills-login"
                        aria-selected="true"
                    >Вход</a>
                </li>
                <li class="nav-item w-50" role="presentation">
                    <a
                        class="nav-link register-nav-link h5 text-center m-0 py-3"
                        id="pills-register-tab"
                        data-toggle="pill"
                        href="#pills-register"
                        role="tab"
                        aria-controls="pills-register"
                        aria-selected="false"
                    >Регистрация</a>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div
                    class="tab-pane fade show active"
                    id="pills-login"
                    role="tabpanel"
                    aria-labelledby="pills-login-tab"
                >
                    <form method="POST" action="{{ route('login') }}">
                        <div class="modal-body">
                            @csrf
                            <label
                                for="email"
                                class="col-form-label text-md-left pb-1"
                            >
                                {{ __('E-Mail Адрес') }}
                            </label>
                            <input
                                required
                                autofocus
                                id="email"
                                type="email"
                                name="email"
                                autocomplete="email"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror mb-2"
                            >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label
                                for="password"
                                class="col-form-label text-md-left pb-1"
                            >
                                {{ __('Пароль') }}
                            </label>
                            <input
                                required
                                id="password"
                                type="password"
                                name="password"
                                autocomplete="current-password"
                                class="form-control @error('password') is-invalid @enderror mb-2"
                            >
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <div class="form-group row justify-content-center m-0">
                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    {{ __('Вход') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Забыл пароль?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div
                    class="tab-pane fade"
                    id="pills-register"
                    role="tabpanel"
                    aria-labelledby="pills-register-tab"
                >
                    <form method="POST" action="{{ route('register') }}">
                        <div class="modal-body">
                            @csrf
                            <label for="user-name" class="col-form-label text-md-left py-1">{{ __('Имя') }}</label>
                            <input
                                required
                                autofocus
                                name="name"
                                type="text"
                                id="user-name"
                                autocomplete="name"
                                value="{{ old('name') }}"
                                class="form-control mb-2 @error('name') is-invalid @enderror"
                            >
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="user-email"
                                   class="col-form-label text-md-left py-1">{{ __('E-Mail Адрес') }}</label>
                            <input
                                required
                                name="email"
                                type="email"
                                id="user-email"
                                class="form-control mb-2 @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                autocomplete="email"
                            >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="user-password"
                                   class="col-form-label text-md-left py-1">{{ __('Пароль') }}</label>
                            <input
                                required
                                id="user-password"
                                type="password"
                                name="password"
                                autocomplete="new-password"
                                class="form-control mb-2 @error('password') is-invalid @enderror"
                            >
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label
                                for="password-confirm"
                                class="col-form-label text-md-left py-1"
                            >{{ __('Подтвердите Пароль') }}</label>
                            <input
                                required
                                type="password"
                                id="password-confirm"
                                class="form-control mb-2"
                                autocomplete="new-password"
                                name="password_confirmation"
                            >

                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input
                                    required
                                    type="checkbox"
                                    name="privacy_policy"
                                    id="privacy_policy"
                                    value="{{old('option')}}"
                                    class="form-check-input custom-control-input m-0"
                                    @if(old('privacy_policy')) checked @endif value="1"
                                >
                                <label
                                    for="privacy_policy"
                                    class="custom-control-label col-form-label text-md-left py-0"
                                >
                                    {{ __('Создавая аккаунт, я принимаю условия, изложенные в') }}
                                    <a href="/terms-of-use">полльзовательском соглашении</a> и даю согласие на
                                    <a href="/privacy-policy">обработку персональных данных.</a>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">{{ __('Регистрация') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{--@if($errors->has('email') || $errors->has('password'))--}}
@if ($errors->any())
    <script>
        $(function () {
            $('#loginModal').modal({
                show: true
            });
        });
    </script>
@endif


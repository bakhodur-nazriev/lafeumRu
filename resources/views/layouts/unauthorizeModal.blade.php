<div class="modal" tabindex="-1" id="staticBackdrop" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">

                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-authorization-tab" data-toggle="pill"
                           href="#pills-authorization" role="tab" aria-controls="pills-authorization"
                           aria-selected="true">Авторизация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-registration-tab" data-toggle="pill" href="#pills-registration"
                           role="tab" aria-controls="pills-registration" aria-selected="false">Регистрация</a>
                    </li>
                </ul>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="tab-content" id="pills-tabContent">
                {{-- Authorization content section --}}
                <div class="tab-pane fade show active" id="pills-authorization" role="tabpanel"
                     aria-labelledby="pills-authorization-tab">
                    <form style="width: 100%;" method="POST" action="{{ route('login') }}">
                        <div class="modal-body">
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-secondary"
                                    style="background-color: #04718c; color: white;">
                                {{ __('Вход') }}
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Registration content section --}}
                <div class="tab-pane fade" id="pills-registration" role="tabpanel"
                     aria-labelledby="pills-registration-tab">
                    <form method="POST" action="{{ route('register') }}">
                        <div class="modal-body">
                            <div class="form-group row mb-0 align-items-center">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0 align-items-center">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Адрес') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0 align-items-center">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0 align-items-center">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Подтвердите пароль') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Регистрация') }}
                            </button>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

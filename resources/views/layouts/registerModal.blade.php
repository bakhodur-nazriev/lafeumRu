<div
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
    id="registerModal"
    aria-labelledby="staticBackdropLabel"
    class="modal fade pr-0 overflow-hidden"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Форма регистрация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('register') }}">

                <div class="modal-body">
                    @csrf
                    <div class="form-group row align-items-center flex-column mb-0">
                        <label for="user-name" class="col-md-8 col-form-label text-md-left py-1">{{ __('Имя') }}</label>
                        <div class="col-md-8 py-1">
                            <input
                                id="user-name"
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autocomplete="name"
                                autofocus
                            >
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group align-items-center row flex-column mb-0">
                        <label for="user-email"
                               class="col-md-8 col-form-label text-md-left py-1">{{ __('E-Mail Адрес') }}</label>
                        <div class="col-md-8 py-1">
                            <input
                                id="user-email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                            >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group align-items-center row flex-column mb-0">
                        <label for="user-password"
                               class="col-md-8 col-form-label text-md-left py-1">{{ __('Пароль') }}</label>
                        <div class="col-md-8 py-1">
                            <input
                                required
                                id="user-password"
                                type="password"
                                name="password"
                                autocomplete="new-password"
                                class="form-control @error('password') is-invalid @enderror"
                            >
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row align-items-center flex-column mb-0">
                        <label for="password-confirm"
                               class="col-md-8 col-form-label text-md-left py-1">{{ __('Подтвердите Пароль') }}</label>
                        <div class="col-md-8 py-1">
                            <input
                                required
                                type="password"
                                class="form-control"
                                id="password-confirm"
                                autocomplete="new-password"
                                name="password_confirmation"
                            >
                        </div>
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

<div
    tabindex="-1"
    role="dialog"
    id="loginModal"
    aria-hidden="true"
    aria-labelledby="loginModalLabel"
    class="modal fade px-3 rounded overflow-hidden"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Форма входа</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('login') }}">
                <div class="modal-body">
                    @csrf
                    <label for="email"
                           class="col-form-label text-md-left pb-1">{{ __('E-Mail Адрес') }}</label>
                    <input
                        id="email"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror mb-2"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                    >
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label for="password"
                           class="col-form-label text-md-left pb-1">{{ __('Пароль') }}</label>
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
                    <div class="form-group row mb-0">
                        <div class="col-md-12 text-center">
                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                {{ __('Вход') }}
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#registerModal"
                            >
                                Регистрация
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



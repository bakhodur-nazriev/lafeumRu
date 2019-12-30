@extends('layouts.empty')

@section('content')
    <v-container fill-height fluid>
        <v-layout class="justify-center align-center">
            <v-flex xs12 sm8 md4 class="align-center">
                <v-card>
                    <v-form method="POST" action="{{ route('register') }}">
                        @csrf
                        <v-toolbar dark flat color="primary">
                            <v-toolbar-title>Регистрация</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <input
                                type="hidden"
                                name="remember"
                                value="1"
                            />
                            <v-text-field
                                name="name"
                                label="Полное имя"
                                required
                                value="{{ old('name') }}"
                                class="@error('name') is-invalid @enderror"
                                prepend-icon="mdi-account"
                                :error-messages="{{ json_encode($errors->get('name')) }}"
                            ></v-text-field>
                            <v-text-field
                                name="email"
                                label="Email"
                                required
                                value="{{ old('email') }}"
                                class="@error('email') is-invalid @enderror"
                                autocomplete="email"
                                prepend-icon="mdi-email"
                                :error-messages="{{ json_encode($errors->get('email')) }}"
                            ></v-text-field>
                            <v-text-field
                                id="password"
                                name="password"
                                type="password"
                                label="Пароль"
                                required
                                prepend-icon="mdi-lock"
                                :error-messages="{{ json_encode($errors->get('password')) }}"
                            ></v-text-field>
                            <v-text-field
                                id="password-confirm"
                                name="password_confirmation"
                                type="password"
                                label="Подтвердите пароль"
                                required
                                prepend-icon="mdi-lock"
                                :error-messages="{{ json_encode($errors->get('confirm_password')) }}"
                            ></v-text-field>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" color="primary">Регистрация</v-btn>
                            <v-btn href="{{route('home')}}" color="primary">
                                <span class="white--text">Отмена</span>
                            </v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

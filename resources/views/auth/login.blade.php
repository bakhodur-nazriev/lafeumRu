@extends('layouts.empty')

@section('content')
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
                <v-layout justify-center class="mb-5">
                    <v-flex xs8>
                        {{-- < :rules="nameRules" v-img :src="'/img/lafeum.png'" /> --}}
                    </v-flex>
                </v-layout>
                <v-card height="100%">
                    <v-form
                        action="{{ route('login') }}"
                        method="POST"
                    >
                        @csrf
                        <v-toolbar dark flat color="primary">
                            <v-toolbar-title>Авторизация</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-card-text>
                            <input
                                type="hidden"
                                name="remember"
                                value="1"
                            />

                            <v-text-field
                                name="email"
                                label="Email"
                                prepend-icon="mdi-account"
                                :error-messages="{{ json_encode($errors->get('email')) }}"
                            ></v-text-field>

                            <v-text-field
                                name="password"
                                type="password"
                                label="Пароль"
                                prepend-icon="mdi-lock"
                                :error-messages="{{ json_encode($errors->get('password')) }}"
                            ></v-text-field>

                        </v-card-text>
                        <v-card-actions>
                            {{--<v-btn text color="primary">Забыл пароль</v-btn>--}}
                            <v-btn text color="primary"><a href="{{ route('register') }}">Регистрация</a></v-btn>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" color="primary">Вход</v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

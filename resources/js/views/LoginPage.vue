<template>
    <v-col cols="8">
        <h5 class="text-uppercase font-weight-regular py-4">логин</h5>
        <v-card elevation="0" max-width="566" class="card rounded-lg mx-auto">
            <v-card-title class="pa-0">
                <h2 class="mb-4 display-1 font-weight-medium">Вход</h2>
            </v-card-title>
            <div class="card-subtitle pa-0 mt-0 mb-10">
                Добро пожаловать, мы ждали Вас !
            </div>
            <v-card-text class="pa-0">
                <form ref="form" :action="appPath('login')" method="POST">
                    <input type="hidden" name="_token" :value="csrf"/>
                    <div class="input-container">
                        <label class="input-label" for="email">Ваш Email</label>
                        <br/>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="input"
                            placeholder="Введите Ваш E-mail"
                            v-model.trim="$v.email.$model"
                            :class="{
                                'is-invalid': $v.email.$error,
                                'is-valid': !$v.email.$invalid,
                            }"
                        />
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            <span v-if="!$v.email.required">Это поле обязательное.
                                <button type="button" @click="clearEmail">
                                    <v-icon class="v-icon">mdi-close</v-icon>
                                </button>
                            </span>
                            <span v-if="!$v.email.email">E-mail должен быть действительным.
                                <button type="button" @click="clearEmail">
                                    <v-icon class="v-icon">mdi-close</v-icon>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="password">Пароль</label>
                        <br/>
                        <input
                            class="input"
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Введите Ваш пароль"
                            v-model.trim="$v.password.$model"
                            :class="{
                                'is-invalid': $v.password.$error,
                                'is-valid': !$v.password.$invalid,
                            }"
                        />
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            <span v-if="!$v.password.required">Введите Ваш пароль.
                                <button type="button" @click="clearPassword">
                                    <v-icon class="v-icon">mdi-close</v-icon>
                                </button>
                            </span>
                            <span v-if="!$v.password.minLength">Пароль должен содержать минимум
                                {{ $v.password.$params.minLength.min }}
                                символов.
                                <button type="button" @click="clearPassword">
                                    <v-icon class="v-icon">mdi-close</v-icon>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="grid-container">
                        <div>
                            <label class="checkbox-label" for="checkbox">
                                <input
                                    v-model="checked"
                                    class="checkbox"
                                    type="checkbox"
                                    name="checkbox"
                                    id="checkbox"
                                />
                                <span class="checkmark"></span>
                                Запомнить меня
                            </label>
                        </div>
                        <div class="grid-container-item">
                            <a href="#">Забыли пароль?</a>
                        </div>
                    </div>
                    <v-btn
                        color="submit-btn"
                        @click="$refs.login.submit()"
                        class="text-capitalize rounded-lg text-decoration-none primary"
                        elevation="0"
                    >
                        вход
                    </v-btn>

                    <form
                        ref="login"
                        action="/login"
                        method="POST"
                        style="display: none;"
                    >
                        <input type="hidden" name="_token" :value="csrf"/>
                    </form>

                    <div class="d-flex justify-content-center mt-5">
                        <span class="grey--text lighten-1 mr-4">У вас нет аккаунта ?</span>
                        <a href="/register">Регистрация</a>
                    </div>
                </form>
            </v-card-text>
        </v-card>
        <div class="space"></div>
    </v-col>
</template>

<script>
import {required, minLength, email} from "vuelidate/lib/validators";

export default {
    data() {
        return {
            email: "",
            password: "",
            checked: false,
            csrf: window.Laravel.csrf_token,
        };
    },
    validations: {
        email: {
            required,
            email,
        },
        password: {
            required,
            minLength: minLength(4),
        },
    },
    methods: {
        clearEmail() {
            this.email = "";
        },
        clearPassword() {
            this.password = "";
        },
        login() {
            this.$v.$touch()
            if (this.$v.$invalid) {
                console.log('Fail')
            } else {
                const user = {
                    email: this.email,
                    password: this.password,
                    remember: this.checked
                }

                // console.log(user)
            }
        },
        appPath(url) {
            window.laravel + url;
        },
        submit() {
            let valid = this.$refs.form.validate();
            if (valid) {
                this.$refs.form.$el.submit();
            }
        },
    },
};
</script>


<style scoped>
.card {
    margin-bottom: 40px;
    padding: 66px 90px 117px 99px;
    background-color: #f5f5f5 !important;
    border: none;
}

.card-subtitle {
    font-weight: 300;
    font-size: 16px;
    line-height: 110%;
    color: rgba(40, 44, 64, 0.5);
}

.input-container {
    position: relative;
    margin-bottom: 18px;
}

.input-label {
    font-size: 12px;
    font-weight: 500;
    color: #82869a;
    line-height: 110%;
}

.input {
    color: rgba(55, 60, 86, 1);
    line-height: 110%;
    font-weight: 500;
    display: block;
    width: 100%;
    border-bottom: 2px solid rgba(199, 199, 199, 0.5);
    padding: 9px 0;
}

.input:focus {
    outline: none;
}

.input::placeholder,
.checkbox-label {
    color: rgba(130, 134, 154, 0.5);
    line-height: 110%;
    font-size: 14px;
    font-weight: 400;
}

.checkbox-label {
    position: relative;
    padding-left: 30px;
    cursor: pointer;
}

.checkbox-label:hover input ~ .checkmark {
    background-color: rgb(219, 219, 219);
    border-color: rgb(161, 161, 161);
}

.checkbox {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: absolute;
    box-sizing: border-box;
    height: 20px;
    width: 20px;
    background-color: rgba(230, 230, 230, 1);
    border: 1px solid rgba(216, 216, 216, 1);
    border-radius: 50%;
    left: 0px;
    top: -3px;
}

.checkmark::after {
    display: none;
    content: "";
    position: absolute;
    left: 6px;
    top: 2.5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

.checkbox-label input:checked ~ .checkmark {
    background-color: rgb(74, 134, 14);
}

.checkbox-label input:checked ~ .checkmark::after {
    display: block;
}

.grid-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    padding-top: 10px;
}

.grid-container-item {
    text-align: end;
}

.grid-container-item a {
    padding-right: 16px;
    color: rgba(240, 174, 75, 1);
}

.submit-btn {
    display: block;
    background-color: rgba(4, 113, 140, 1);
    border-radius: 8px;
    width: 100%;
    color: white;
    height: 55px;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
    margin-top: 40px;
}

.submit-btn:focus {
    outline: none;
}

.submit-btn:active {
    opacity: 0.5;
}

.valid-feedback {
    position: absolute;
    top: 51px;
    left: 0px;
    border-bottom: 2px solid;
}

.valid-feedback::after {
    content: "";
    position: absolute;
    right: 7px;
    top: -30px;
    width: 6px;
    height: 14px;
    border: solid rgb(0 195 17);
    border-width: 0px 2px 2px 0;
    transform: rotate(45deg);
}

.invalid-feedback {
    position: absolute;
    top: 51px;
    left: 0px;
    border-top: 2px solid;
}

.invalid-feedback button {
    position: absolute;
    top: -35px;
    right: 0px;
}

button:focus {
    outline: none;
}

.v-icon {
    color: inherit !important;
}

@media screen and (max-width: 599px) {
    .card {
        padding: 40px;
    }

    h2 {
        font-size: 30px;
    }
}
</style>

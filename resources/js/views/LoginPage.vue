<template>
    <v-col col-sm="12" col-lg="8">
        <v-card
            elevation="0"
            max-width="500"
            class="card rounded-lg mx-auto"
        >
            <v-card-title class="pa-0">
                <h2 class="mb-4 display-1 font-weight-medium">Вход</h2>
            </v-card-title>
            <v-card-text class="pa-0">
                <v-form ref="form" @submit.prevent="login" @keyup.enter="login">
                    <input type="hidden" name="_token" :value="csrf"/>
                    <v-col class="px-0">
                        <v-text-field
                            clearable
                            type="email"
                            name="email"
                            v-model="email"
                            label="Введите Ваш E-mail"
                            :rules="[rules.required, rules.email]"
                        />
                    </v-col>
                    <v-col class="px-0">
                        <v-text-field
                            counter
                            maxlength="50"
                            type="password"
                            name="password"
                            v-model="password"
                            label="Введите Ваш пароль"
                            :rules="[rules.required, rules.min]"
                            :type="showPassword ? 'text' : 'password'"
                            @click:append="showPassword = !showPassword"
                            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                            @keydown="handleKeyDown"
                        />
                    </v-col>
                    <v-col class="px-0">
                        <v-btn
                            height="48"
                            width="100%"
                            elevation="0"
                            type="submit"
                            class="text-capitalize rounded-lg text-decoration-none primary"
                            :disabled="!$refs.form"
                        >
                            вход
                        </v-btn>
                    </v-col>
                    <v-alert type="error" :value="alert.show" class="rounded-lg m-0" v-if="alert.show">
                        <ul>
                            <li v-if="alert.email">{{ alert.email }}</li>
                            <li v-if="alert.password">{{ alert.password }}</li>
                        </ul>
                    </v-alert>

                    <v-col class="d-flex justify-content-center mt-4">
                        <span class="grey--text mr-4 font-weight-medium">У вас нет аккаунта ?</span>
                        <a class="text-decoration-none primary--text font-weight-medium"
                           href="/register">Регистрация</a>
                    </v-col>
                </v-form>
            </v-card-text>
        </v-card>
    </v-col>
</template>

<script>
export default {
    data() {
        return {
            csrf: window.Laravel.csrf_token,
            email: "",
            password: "",
            showPassword: false,
            rules: {
                required: value => !!value || 'Это поле обязательное.',
                counter: value => value.length <= 20 || 'Максимум 20 символов',
                min: v => v.length >= 3 || 'Минимум 3 символов',
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return pattern.test(value) || 'E-mail должен быть действительным.'
                },
            },
            alert: {
                show: false,
                email: '',
                password: '',
            }
        };
    },
    methods: {
        handleKeyDown(event) {
            if (event.keyCode === 13) {
                this.submit();
            }
        },
        appPath(url) {
            window.laravel + url;
        },
        login() {
            axios
                .post('/login', {
                    email: this.email,
                    password: this.password
                })
                .then(res => {
                    console.log(res);
                    window.location.replace('/');
                })
                .catch(err => {
                    console.log(err);
                    if (err.response && err.response.status === 422 && err.response.data && err.response.data.errors) {
                        const errors = err.response.data.errors;
                        this.updateAlert(errors);
                    }
                })
        },
        updateAlert(errors) {
            this.alert.show = true;
            this.alert.email = errors.email ? errors.email[0] : '';
            this.alert.password = errors.password ? errors.password[0] : '';
        }
    },
};
</script>

<style scoped>
.card {
    margin-bottom: 40px;
    padding: 50px 70px;
    background-color: #f7f7f7 !important;
    border: none;
}

@media (max-width: 767px) {
    .card {
        padding: 25px 30px;
    }
}
</style>

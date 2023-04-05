<template>
    <v-col col-md="12" col-lg=9>
        <v-card
            elevation="0"
            max-width="500"
            class="card rounded-lg mx-auto"
        >
            <v-form ref="form" @submit.prevent="registerUser">
                <input type="hidden" name="_token" :value="csrf"/>
                <v-col class="px-0">
                    <v-text-field
                        clearable
                        type="text"
                        name="name"
                        v-model="name"
                        label="Имя, Фамилия"
                        :rules="[rules.required, rules.min]"
                    />
                </v-col>
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
                        type="password"
                        name="password"
                        v-model="password"
                        label="Введите Ваш пароль"
                        :rules="[rules.required, rules.min]"
                        :type="showPassword ? 'text' : 'password'"
                        @click:append="showPassword = !showPassword"
                        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                    />
                </v-col>
                <v-col class="px-0">
                    <v-text-field
                        type="password"
                        name="password"
                        v-model="password_confirmation"
                        label="Подтверждение пароля"
                        :type="showPasswordConfirm ? 'text' : 'password'"
                        :rules="[rules.required, rules.min, rules.passwordMatch]"
                        @click:append="showPasswordConfirm = !showPasswordConfirm"
                        :append-icon="showPasswordConfirm ? 'mdi-eye' : 'mdi-eye-off'"
                    />
                </v-col>
                <v-col class="px-0">
                    <v-btn
                        height="48"
                        width="100%"
                        elevation="0"
                        type="submit"
                        class="primary rounded-lg text-capitalize font-weight-medium"
                    >
                        Регистрация
                    </v-btn>
                </v-col>
                <v-alert :value="alert.show" type="error" class="rounded-lg m-0">{{ alert.message }}</v-alert>
            </v-form>
            <v-col class="d-flex justify-content-center mt-5 pa-0">
                <span class="grey--text font-weight-medium lighten-1 mr-4">Есть аккаунт ?</span>
                <a class="text-decoration-none primary--text font-weight-medium" href="/login">Вход</a>
            </v-col>
        </v-card>
    </v-col>
</template>

<script>
export default {
    name: "RegisterPage",
    data() {
        return {
            csrf: window.Laravel.csrf_token,
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            showPassword: false,
            showPasswordConfirm: false,
            rules: {
                required: value => !!value || 'Это поле обязательное.',
                counter: value => value.length <= 20 || 'Максимум 20 символов',
                min: v => v.length >= 3 || 'Минимум 3 символов',
                passwordMatch: () => (this.password === this.password_confirmation) || 'Введенный вами пароль не совпадает',
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return pattern.test(value) || 'E-mail должен быть действительным.'
                },
            },
            alert: {
                show: false,
                message: ''
            }
        }
    },
    methods: {
        async registerUser() {
            try {
                const response = await axios.post('/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                });

                console.log(response.data);
                window.location.replace('/');
            } catch (error) {
                this.alert.show = true;
                this.alert.message = error.response.data.errors.password[0];
                this.alert.message = error.response.data.errors.email[0];
                this.alert.message = error.response.data.errors.name[0];
            }
        }
    },
};
</script>
<style scoped>
.card {
    margin-bottom: 40px;
    padding: 50px 70px;
    background-color: #f7f7f7 !important;
}

@media (max-width: 767px) {
    .card {
        padding: 25px 30px;
    }
}
</style>

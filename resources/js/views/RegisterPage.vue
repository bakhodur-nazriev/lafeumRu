<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <h1 class="mb-0 text-uppercase">Регистрация</h1>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-card 
                elevation="0" 
                max-width="566" 
                class="card mx-auto rounded-lg"
                >
                    <v-card-title class="card-title font-weight-bold pa-0 mb-4">
                        Регистрация
                    </v-card-title>
                    <v-card-subtitle class="card-subtitle pa-0 mt-0 mb-10">
                        <a href="#">У Вас есть аккаунт?</a>
                    </v-card-subtitle>
                    <v-card-text class="pa-0">
                        <v-form ref="form" v-model="valid" lazy-validation="lazy-validation">
                            <v-text-field
                                class="mt-0"
                                clearable
                                v-model="name"
                                :rules="nameRules"
                                name="name"
                                label="Имя, Фамилия"
                                type="text"
                                validate-on-blur
                                placeholder="Abuamr Gafurov"
                            ></v-text-field>
                            <v-text-field
                                class="mt-0"
                                clearable
                                v-model="email"
                                :rules="emailRules"
                                name="email"
                                label="Ваш Email"
                                type="email"
                                validate-on-blur
                                placeholder="Введите Ваш Email"
                            ></v-text-field>
                            <v-text-field
                                class="mt-2 mb-2"
                                label="Пароль"
                                placeholder="Введите Ваш пароль"
                                v-model="password"
                                name="password"
                                type="password"
                                clearable
                                :rules="passwordRules"
                                validate-on-blur
                            ></v-text-field>
                            <v-text-field
                                class="mt-2 mb-2"
                                label="Подтверждение пароля"
                                placeholder="Ваш пароль"
                                v-model="confirmPassword"
                                name="confirmPassword"
                                type="password"
                                clearable
                                :rules="confirmRules"
                                validate-on-blur
                            ></v-text-field>
                        </v-form>
                        <v-card-actions class="pa-0">
                            <v-btn 
                            :disabled="!valid"
                            class="button mt-5"
                            color="rgba(4,113,140,1)"
                            height="55"
                            block 
                            elevation="2"
                            @click="submit"
                            >
                                <span>Регистрация</span>
                            </v-btn>
                        </v-card-actions>
                    </v-card-text>
                </v-card>
                <div class="space"></div>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    export default {
        name: "Login",
        data () {
            return {
                valid: false,
                name: '',
                nameRules: [
                    value => !!value || 'Это поле обязательное',
                ],
                email: '',
                emailRules: [
                    value => !!value || 'E-mail обязательна',
                    value => /.+@.+/.test(value) || 'E-mail должна быть действительной'
                ],
                password: '',
                passwordRules: [
                    value => !!value || 'Это поле обязательное',
                    value => (value && value.length) >= 8 || 'Слишком короткий'
                ],
                confirmPassword: '',
                confirmRules: [
                    v => !!v || 'Требуется подтверждение',
                    v => (v == this.password) || 'Пароли не совпадают'
                ]
            }
        },
        methods: {
            submit() {
                if (this.$refs.form.validate()) {
                    const user = {
                        name: this.name,
                        email: this.email,
                        password: this.password
                    }
                    console.log(user)
                }
            }
        }
    };
</script>

<style scoped>
    h1 {
        font-size: 16px;
        color: rgba(108, 108, 100, 1);
        margin-top: 10px;
    }
    .card {
        margin-top: 10px;
        border: none;
        padding: 66px 90px 117px 99px;
    }
    .card-title {
        font-size: 36px;
        line-height: 40px;
    }
    .card a {
        font-size: 16px;
        line-height: 110%;
        font-weight: 300;
        color: rgba(40, 44, 64, 0.6);
    }
    .button {
        border-radius: 10px;
    }
    span {
        color: white;
        text-transform: none;
        font-weight: 600;
        line-height: 18px;
        font-size: 15px;
        text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.15);
    }                       
    .space {
        height: 164px;
    }
</style>

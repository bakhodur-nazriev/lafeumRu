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
                        Вход
                    </v-card-title>
                    <v-card-subtitle class="card-subtitle pa-0 mt-0 mb-10">
                        Добро пожаловать, мы ждали Вас !
                    </v-card-subtitle>
                    <v-card-text class="pa-0">
                        <v-form ref="form" v-model="valid" lazy-validation="lazy-validation">
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
                            <div class="grid-container">
                                <v-checkbox 
                                color="success"
                                v-model="agreement"
                                label="Запомнить меня"
                                on-icon="mdi-check-circle"
                                off-icon="mdi-circle-outline"
                                ></v-checkbox>
                                <div class="grid-item">
                                    <a href="#">Забыли пароль?</a>
                                </div>
                            </div>
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
                                <span>Вход</span>
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
        name: "LoginPage",
        data () {
            return {
                valid: false,
                email: '',
                emailRules: [
                    value => !!value || 'E-mail обязательна',
                    value => /.+@.+/.test(value) || 'E-mail должна быть действительной'
                ],
                password: '',
                passwordRules: [
                    value => !!value || 'Это поле обязательное'
                ],
                agreement: false
            }
        },
        methods: {
            submit() {
                if (this.$refs.form.validate()) {
                    const user = {
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
    .card-subtitle {
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
    .grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        margin-top: -20px;
    }
    .grid-item {
        justify-self: end;
        align-self: center;
    }
    .grid-item a {
        font-size: 14px;
        color: #F0AE4B;
        font-weight: 500;
        line-height: 110%;
        padding-right: 18px;
    }
    .space {
        height: 246px;
    }
</style>

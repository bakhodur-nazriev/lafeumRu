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
                class="card rounded-lg mx-auto"
                >
                    <v-card-title class="pa-0">
                        <h2 class="mb-4">Регистрация</h2>
                    </v-card-title>
                    <div class="card-subtitle pa-0 mt-0 mb-10">
                        <a href="#">У Bас есть аккаунт?</a>
                    </div>
                    <v-card-text class="pa-0">
                        <form>
                            <div class="input-container">
                                <label class="input-label" for="name">Имя, Фамилия</label> <br>
                                <input class="input" type="text" name="name" id="name" placeholder="Abuamr Gafurov">
                            </div>
                            <div class="input-container">
                                <label class="input-label" for="email">Ваш Email</label> <br>
                                <input class="input" type="email" name="email" id="email" placeholder="Введите Ваше E-mail">
                            </div>
                            <div class="input-container">
                                <label class="input-label" for="password">Пароль</label> <br>
                                <input class="input" type="password" name="password" id="password" placeholder="Введите Ваш пароль">
                            </div>
                            <div class="input-container">
                                <label class="input-label" for="confirmPassword">Подтверждение пароля</label> <br>
                                <input class="input" type="password" name="confirmPassword" id="confirmPassword" placeholder="Ваш пароль">
                            </div>
                            <button class="submit-btn" type="submit">Регистрация</button>
                        </form>
                    </v-card-text>
                </v-card>
                <div class="space"></div>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name: 'RegisterPage',
    data() {
        return {}
    }
}
</script>


<style scoped>
    h1 {
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        color: #6C6C64;
    }
    h2 {
        font-size: 36px;
        font-weight: 600;
        line-height: 110%;
        letter-spacing: -1px;
    }
    .card {
        margin-bottom: 200px;
        padding: 66px 90px 96px 99px;
        background-color: #f5f5f5 !important;
        border: none;
    }
    .card-subtitle a {
        font-weight: 300;
        font-size: 16px;
        line-height: 110%;
        color: rgba(40, 44, 64, 0.7);
    }
    .input-container {
        margin-bottom: 18px;
    }
    .input-label {
        font-size: 12px;
        font-weight: 500;
        color: #82869A;
        line-height: 110%;
    }
    .input {
        color: rgba(55,60,86,1);
        line-height: 110%;
        font-weight: 500;
        display: block;
        width: 100%;
        border-bottom: 2px solid rgb(199 199 199 / 50%);
        padding: 9px 0;
    }
    .input:focus {
        outline: none;
    }
    .input::placeholder {
        color: rgba(130, 134, 154, 0.5);
        line-height: 110%;
        font-size: 14px;
        font-weight: 400;
    }
    .submit-btn {
        display: block;
        background-color: rgba(4,113,140,1);
        border-radius: 8px;
        width: 100%;
        color: white;
        height: 55px;
        box-shadow: 0 12px 40px rgb(0 0 0 / 20%);
        margin-top: 40px;
        letter-spacing: 1px;
    }
    .submit-btn:focus {
        outline: none;
    }
    .submit-btn:active {
        opacity: 0.5;
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

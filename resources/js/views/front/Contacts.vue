<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <h1 class="text-uppercase mb-0">Контакты</h1>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" lg="6">
                <h2 class="mb-0">Контакты</h2>
                <p class="contact-text mt-2 pr-4 mb-8">
                    Мы рады, что Вы посетили наш сайт и ознакомились с находящейся на нем информацией.
                    Вся информация находится в свободном доступе и предназначена только для частного пользования.
                    Если Вы считаете, что Ваша работа была размещена на нашем сайте в нарушение Вашего авторского права,
                    сообщите нам об этом, используя обратную связь.
                    Будем рады рассмотреть Ваши рекомендации по усовершенствованию сайта.
                </p>
                <div class="item mb-11">
                    <h3 class="mb-3">Электронная почта</h3>
                    <a href="mailto:info@lafeum.org">info@lafeum.org</a>
                </div>
                <div class="item">
                    <h3 class="mb-3">Адрес</h3>
                    <a href="mailto:info@lafeum.org">info@lafeum.org</a>
                </div>
            </v-col>
            <v-col cols="12" lg="6">
                <v-card 
                elevation="0"
                max-width="566"
                class="card rounded-lg mx-auto"
                >
                    <v-card-title class="pa-0">
                        <h2 class="mb-4">Свяжитесь с нами</h2>
                    </v-card-title>
                    <div class="card-subtitle pa-0 mt-0 mb-10">
                        Добро пожаловать, мы ждали Вас !
                    </div>
                    <v-card-text class="pa-0">
                        <form>
                            <div class="input-container">
                                <label class="input-label" for="name">Ваше Имя</label> <br>
                                <input class="input" type="text" name="name" id="name" placeholder="Введите Ваше имя">
                            </div>
                            <div class="input-container">
                                <label class="input-label" for="email">Ваша Почта</label> <br>
                                <input class="input" type="email" name="email" id="email" placeholder="Введите адрес электронной почты">
                            </div>
                            <div class="input-container">
                                <label class="input-label" for="password">Пароль</label> <br>
                                <input class="input" type="password" name="password" id="password" placeholder="Введите Ваш пароль">
                            </div>
                            <div class="textarea-container">
                                <label class="input-label" for="message">Сообщение</label> <br>
                                <textarea class="message" name="message" id="message" cols="30" rows="10"></textarea>
                            </div>
                            <button class="submit-btn" type="submit">Вход</button>
                        </form>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name: 'contacts',
    data () {
        return {}
    }
}
</script>
<style scoped>
    h1 {
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        letter-spacing: 0.07em;
        color: #6C6C64;
    }
    h2 {
        font-size: 36px;
        font-weight: 600;
        line-height: 110%;
        letter-spacing: -1px;
    }
    .contact-text {
        font-size: 14px;
        line-height: 136%;
        color: #676767;
        max-width: 720px;
    }
    h3 {
        font-size: 22px;
        line-height: 110%;
        font-weight: 700;
        color: #494949;
    }
    .item a {
        font-size: 18px;
        line-height: 110%;
        color: #676767;
    }
    .item:last-child {
        margin-bottom: 100px;
    }
    .card {
        margin-bottom: 149px;
        padding: 66px 90px 78px 99px;
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
    .message {
        display: block;
        width: 100%;
        background-color: rgb(239 239 239);
        border-radius: 8px;
        margin-top: 8px;
        resize: none;
        max-height: 100px;
    }
    .message:focus {
        outline: none;
    }
    .submit-btn {
        display: block;
        background-color: rgba(4,113,140,1);
        border-radius: 8px;
        width: 100%;
        color: white;
        height: 55px;
        box-shadow: 0 12px 40px rgb(0 0 0 / 20%);
        margin-top: 45px;
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
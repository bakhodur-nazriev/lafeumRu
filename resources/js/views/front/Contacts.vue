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
                        <form @submit.prevent="submitForm">
                            <div class="input-container">
                                <label class="input-label" for="name">Ваше Имя</label> <br>
                                <input class="input" type="text" name="name" id="name" placeholder="Введите Ваше имя"
                                    v-model.trim="$v.name.$model" 
                                    :class="{ 'is-invalid':$v.name.$error, 'is-valid':!$v.name.$invalid }"
                                >
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">
                                    <span v-if="!$v.name.required">Это поле обязательное. <button type="button" @click="clearName"><v-icon class="v-icon">mdi-close</v-icon></button></span>
                                    <span v-if="!$v.name.minLength">Это поле должен содержать минимум {{ $v.name.$params.minLength.min }} букв. <button type="button" @click="clearName"><v-icon class="v-icon">mdi-close</v-icon></button></span>
                                    <span v-if="!$v.name.maxLength">Это поле не может содержать более {{ $v.name.$params.maxLength.max }} букв. <button type="button" @click="clearName"><v-icon class="v-icon">mdi-close</v-icon></button></span>
                                </div>
                            </div>
                            <div class="input-container">
                                <label class="input-label" for="email">Ваша Почта</label> <br>
                                <input class="input" type="email" name="email" id="email" placeholder="Введите адрес электронной почты"
                                    v-model.trim="$v.email.$model" 
                                    :class="{ 'is-invalid':$v.email.$error, 'is-valid':!$v.email.$invalid }"    
                                >
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">
                                    <span v-if="!$v.email.required">Это поле обязательное. <button type="button" @click="clearEmail"><v-icon class="v-icon">mdi-close</v-icon></button></span>
                                    <span v-if="!$v.email.email">E-mail должен быть действительным. <button type="button" @click="clearEmail"><v-icon class="v-icon">mdi-close</v-icon></button></span>
                                </div>
                            </div>
                            <div class="input-container">
                                <label class="input-label" for="password">Пароль</label> <br>
                                <input class="input" type="password" name="password" id="password" placeholder="Введите Ваш пароль"
                                    v-model.trim="$v.password.$model" 
                                    :class="{ 'is-invalid':$v.password.$error, 'is-valid':!$v.password.$invalid }"
                                >
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">
                                    <span v-if="!$v.password.required">Введите Ваш пароль. <button type="button" @click="clearPassword"><v-icon class="v-icon">mdi-close</v-icon></button></span>
                                    <span v-if="!$v.password.minLength">Пароль должен содержать минимум {{ $v.password.$params.minLength.min }} символов. <button type="button" @click="clearPassword"><v-icon class="v-icon">mdi-close</v-icon></button></span>
                                </div>
                            </div>
                            <div class="textarea-container">
                                <label class="input-label" for="message">Сообщение</label> <br>
                                <div class="green-border" v-if="!$v.message.$invalid"></div>
                                <div class="red-border" v-if="$v.message.$error"></div>
                                <textarea class="message" name="message" id="message" cols="30" rows="10"
                                    v-model.trim="$v.message.$model"
                                    :class="{ 'is-invalid':$v.message.$error, 'is-valid':!$v.message.$invalid }"
                                ></textarea>
                                <div class="invalid-feedback">
                                    <button type="button" @click="clearMessage"><v-icon class="v-icon">mdi-close</v-icon></button>
                                    <span v-if="!$v.message.required">Это поле обязательное.</span>
                                    <span v-if="!$v.message.minLength">Пароль должен содержать минимум {{ $v.message.$params.minLength.min }} символов. </span>
                                    <span v-if="!$v.message.maxLength">Это поле не может содержать более {{ $v.message.$params.maxLength.max }} букв. </span>
                                </div>
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
import { required, minLength, maxLength, email, sameAs } from 'vuelidate/lib/validators'
export default {
    name: 'Contacts',
    data() {
        return {
            name: '',
            email: '',
            password: '',
            message: ''
        }
    },
    validations: {
        name: {
            required,
            minLength: minLength(5),
            maxLength: maxLength(30)
        },
        email: {
            required,
            email
        },
        password: {
            required,
            minLength: minLength(8)
        },
        message: {
            required,
            minLength: minLength(10),
            maxLength: maxLength(100)
        }
    },
    methods: {
        clearName () {
            this.name = ''
        },
        clearEmail () {
            this.email = ''
        },
        clearPassword () {
            this.password = ''
        },
        clearMessage () {
            this.message = ''
        },
        submitForm () {
            this.$v.$touch() 
            if(this.$v.$invalid) {
                console.log('Fail')
            } else {
                const user = {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    message: this.message
                }
                console.log(user)
            }
        }
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
        position: relative;
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
        padding: 10px;
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
    .valid-feedback::after, .green-border::after {
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
    .green-border::after {
        top: 105px;
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
    .textarea-container {
        position: relative;
    }
    .textarea-container .invalid-feedback {
        top: 125px;
        border: none;
        left: 0px;
    }
    .textarea-container .invalid-feedback span {
        position: absolute;
        top: 0px;
    }
    .textarea-container button {
        position: absolute;
        top: -104px;
        right: 0px;
    }
    .red-border, .green-border {
        margin-bottom: -110px;
        margin-left: -2px;
        height: 104px;
        border-radius: 10px;
        width: 101.5%;
        border: 2px solid #e3342f !important;
        background-color: rgb(239 239 239);
    }
    .green-border {
        border: 2px solid rgb(0 195 17) !important;
    }
    textarea::-webkit-scrollbar {
        width: 0px;
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
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
                    <v-card-subtitle class="card-subtitle pa-0 mt-0 mb-10">
                        Добро пожаловать, мы ждали Вас !
                    </v-card-subtitle>
                    <v-card-text class="pa-0">
                        <v-form ref="form" v-model="valid" lazy-validation>
                            <v-text-field
                                name="name"
                                v-model="name"
                                :rules="nameRules"
                                validate-on-blur
                                label="Ваше Имя"
                                placeholder="Абуамр"
                                type="text"
                                clearable
                            ></v-text-field>
                            <v-text-field
                                name="email"
                                v-model="email"
                                :rules="emailRules"
                                validate-on-blur
                                label="Ваша Почта"
                                placeholder="Введите адрес электронной почты"
                                type="email"
                                clearable
                            ></v-text-field>
                            <v-text-field
                                name="password"
                                v-model="password"
                                :rules="passwordRules"
                                validate-on-blur
                                label="Пароль"
                                placeholder="Введите Ваш пароль"
                                type="password"
                                clearable
                            ></v-text-field>
                            <v-textarea
                                v-model="message"
                                :rules="messageRules"
                                class="rounded-lg "
                                background-color="rgba(249, 249, 249, 1)"
                                label="Сообщение"
                                placeholder=" "
                                clearable
                                loading="false"
                                no-resize
                                validate-on-blur
                            ></v-textarea>
                        </v-form>
                        <v-card-action>
                            <v-btn
                                block
                                class="rounded-lg mt-10"
                                height="55"
                                color="rgba(4,113,140,1)"
                            ><span>Вход</span></v-btn>
                        </v-card-action>
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
        return {
            valid: false,
            name: '',
            nameRules: [
                value => !!value || 'Это поле обязательное'
            ],
            email: '',
            emailRules: [
                value => !!value || 'E-mail обязательна',
                value => /.+@.+/.test(value) || 'E-mail должна быть действительной'
            ],
            password: '',
            passwordRules: [
                value => !!value || 'E-mail обязательна'
            ],
            message: "",
            messageRules: [
                value => !!value || 'Это поле не должно быть пустым',
                value => (value && value.length) >= 6 || 'Слишком короткий'
            ]
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
        font-weight: 700;
        line-height: 110%;
    }
    .contact-text {
        font-size: 14px;
        line-height: 136%;
        color: #676767;
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
    .card {
        margin-bottom: 149px;
        padding: 66px 90px 78px 99px;
    }
    .card-subtitle {
        font-weight: 300;
        font-size: 16px;
        line-height: 110%;
        color: rgba(40, 44, 64, 0.6);
    }
    span {
        color: white;
        text-transform: none;
        font-weight: 600;
        line-height: 18px;
        font-size: 15px;
        text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.15);
    }
</style>
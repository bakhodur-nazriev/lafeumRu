<template>
    <v-col xl="8" lg="12">
        <h5 class="text-uppercase font-weight-regular pt-4 pb-1 mb-0">Контакты</h5>
        <v-row justify="center">
            <v-col class="col-md-6 col-sm-12 text-justify">
                <h2 class="display-1 font-weight-medium mb-0">Контакты</h2>
                <p class="mt-2 mb-5">
                    Мы рады, что Вы посетили наш сайт и ознакомились с находящейся на нем информацией.
                    Вся информация находится в свободном доступе и предназначена только для частного пользования.
                    Если Вы считаете, что Ваша работа была размещена на нашем сайте в нарушение Вашего авторского
                    права,
                    сообщите нам об этом, используя обратную связь.
                    Будем рады рассмотреть Ваши рекомендации по усовершенствованию сайта.
                </p>
                <div class="item">
                    <h4 class="mb-0">Электронная почта</h4>
                    <a href="mailto:info@lafeum.ru">info@lafeum.ru</a>
                </div>
            </v-col>
            <v-col class="col-md-6 col-sm-12">
                <v-card
                    width="450"
                    elevation="0"
                    class="card rounded-lg mx-auto"
                >
                    <v-card-title class="pa-0">
                        <h2>Свяжитесь с нами</h2>
                        <v-card-subtitle class="pa-0">
                            Добро пожаловать, мы ждали Вас !
                        </v-card-subtitle>
                    </v-card-title>
                    <v-card-text class="pa-0">
                        <v-form
                            method="POST"
                            ref="contactForm"
                            :action="appPath('contacts')"
                        >
                            <input type="hidden" name="_token" :value="csrf"/>
                            <v-col class="pa-0">
                                <v-text-field
                                    clearable
                                    name="name"
                                    label="Ваше имя"
                                    v-model="form.user_name"
                                    :rules="[rules.required, rules.min]"
                                />
                            </v-col>
                            <v-col class="pa-0">
                                <v-text-field
                                    clearable
                                    type="email"
                                    name="email"
                                    label="Ваше почта"
                                    v-model="form.user_email"
                                    :rules="[rules.required, rules.email]"
                                />
                            </v-col>
                            <v-col class="pa-0">
                                <v-text-field
                                    clearable
                                    name="topic"
                                    label="Тема"
                                    v-model="form.topic"
                                    :rules="[rules.required, rules.min]"
                                />
                            </v-col>
                            <v-col class="pa-0">
                                <v-textarea
                                    counter="500"
                                    name="message"
                                    label="Сообщение"
                                    v-model="form.message"
                                    :rules="[rules.required, rules.min, rules.counter]"
                                ></v-textarea>
                            </v-col>
                            <v-col class="px-0">
                                <vue-recaptcha
                                    sitekey="6LeXjvscAAAAADXmSVnyWyomwBsX_NpDFjHXrA0O"
                                    @verify="markRecaptchaAsVerified"
                                    v-model="recaptchaVerified"
                                ></vue-recaptcha>
                                <v-col class="pb-0 px-0" v-if="recaptchaVerified">
                                    <v-alert
                                        dense
                                        outlined
                                        type="error"
                                        class="mb-0 subtitle-1"
                                    >
                                        Пожалуйста, отметьте рекапчу
                                    </v-alert>
                                </v-col>
                            </v-col>
                            <v-col class="px-0">
                                <v-btn
                                    height="48"
                                    width="100%"
                                    type="submit"
                                    elevation="0"
                                    class="primary rounded-lg text-capitalize font-weight-medium"
                                    @click.prevent="submitContact"
                                >
                                    Отправить
                                </v-btn>
                            </v-col>
                            <v-col class="pa-0">
                                <v-progress-linear
                                    v-if="isLoading"
                                    color="primary accent-4"
                                    indeterminate
                                    rounded
                                    height="6"
                                ></v-progress-linear>
                                <v-alert
                                    dense
                                    v-if="success"
                                    type="success"
                                    class="font-weight-medium rounded-lg mb-0"
                                >
                                    Спасибо! Ваше письмо успешно отправлено!
                                </v-alert>
                                <v-alert
                                    dense
                                    v-if="error"
                                    type="error"
                                    class="font-weight-medium rounded-lg mb-0"
                                >
                                    Ошибка! Вероятно вы робот
                                </v-alert>
                            </v-col>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-col>
</template>

<script>
import VueRecaptcha from 'vue-recaptcha';

export default {
    name: "Contacts",
    components: {VueRecaptcha},
    data() {
        return {
            csrf: window.Laravel.csrf_token,
            recaptchaVerified: false,
            recaptchaMessage: '',
            isLoading: false,
            success: false,
            error: false,
            errors: {},
            form: {
                user_name: "",
                user_email: "",
                topic: "",
                message: "",
            },
            rules: {
                required: value => !!value || 'Это поле обязательное.',
                counter: value => value.length <= 500 || 'Максимум 500 символов',
                min: v => v.length >= 3 || 'Минимум 3 символов',
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return pattern.test(value) || 'E-mail должен быть действительным.'
                },
            }
        }
    },
    methods: {
        submitContact() {
            this.isLoading = true;
            if (this.$refs.contactForm.validate()) {
                if (!this.recaptchaMessage) {
                    this.recaptchaVerified = true;
                } else {
                    axios
                        .post('/api/send-contact', this.form)
                        .then((res) => {
                            this.onSuccess(res.data.message);
                            this.isLoading = false;
                        })
                        .catch((err) => {
                            console.log(err);
                            this.isLoading = false;
                        });
                }
            }
        },
        markRecaptchaAsVerified(response) {
            this.recaptchaMessage = response;
        },
        onSuccess(message) {
            this.success = true;
        },
        clearForm() {
            this.$refs.contactForm.reset();
            this.$refs.contactForm.resetValidation();
        },
        appPath(url) {
            window.laravel + url;
        }
    }
}
</script>
<style scoped>
.item a {
    font-size: 18px;
    color: #676767;
}

.item a:hover {
    color: #04718c;
}

.card {
    margin-bottom: 20px;
    padding: 40px 50px;
    background-color: #f7f7f7 !important;
}

.textarea-container button {
    position: absolute;
    top: -104px;
    right: 0;
}

textarea::-webkit-scrollbar {
    width: 0;
}
</style>

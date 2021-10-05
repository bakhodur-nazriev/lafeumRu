<template>
    <v-col xl="8" lg="12">
        <h5 class="text-uppercase font-weight-regular py-4">Контакты</h5>
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="display-1 font-weight-medium">Контакты</h2>
                <p class="contact-text mt-2 pr-4 mb-8">
                    Мы рады, что Вы посетили наш сайт и ознакомились с находящейся на нем информацией.
                    Вся информация находится в свободном доступе и предназначена только для частного пользования.
                    Если Вы считаете, что Ваша работа была размещена на нашем сайте в нарушение Вашего авторского права,
                    сообщите нам об этом, используя обратную связь.
                    Будем рады рассмотреть Ваши рекомендации по усовершенствованию сайта.
                </p>
                <div class="item mb-11">
                    <h4 class="mb-3">Электронная почта</h4>
                    <a href="mailto:info@lafeum.org">info@lafeum.org</a>
                </div>
                <div class="item">
                    <h4 class="mb-3">Адрес</h4>
                    <a href="mailto:info@lafeum.org">info@lafeum.org</a>
                </div>
            </div>
            <div>
                <v-card
                    width="500"
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
                        <v-form ref="contactForm" method="POST" :action="appPath('contacts')">
                            <input type="hidden" name="_token" :value="csrf"/>
                            <v-col class="px-0 pb-0">
                                <v-text-field
                                    clearable
                                    name="name"
                                    label="Ваше имя"
                                    v-model="form.user_name"
                                    :rules="[rules.required, rules.min]"
                                />
                            </v-col>
                            <v-col class="px-0 pb-0">
                                <v-text-field
                                    clearable
                                    type="email"
                                    name="email"
                                    label="Ваше почта"
                                    v-model="form.user_email"
                                    :rules="[rules.required, rules.email]"
                                />
                            </v-col>
                            <v-col class="px-0 pb-0">
                                <v-text-field
                                    clearable
                                    name="topic"
                                    label="Тема"
                                    v-model="form.topic"
                                    :rules="[rules.required, rules.min]"
                                />
                            </v-col>
                            <v-col class="px-0 pb-0">
                                <v-textarea
                                    counter="500"
                                    name="message"
                                    label="Сообщение"
                                    v-model="form.message"
                                    :rules="[rules.required, rules.min, rules.counter]"
                                ></v-textarea>
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
            </div>
        </div>
    </v-col>
</template>

<script>
export default {
    name: "Contacts",
    data() {
        return {
            csrf: window.Laravel.csrf_token,
            errors: {},
            success: false,
            error: false,
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
            if (this.$refs.contactForm.validate()) {
                axios
                    .post('/api/send-contact', this.form)
                    .then((res) => {
                        this.clearForm();
                        this.onSuccess(res.data.message);
                        console.log(res);
                    })
                    .catch((err) => {
                        if (err.response.status == 422) {
                            this.setErrors(err.response.data.errors);
                        } else {
                            this.onFailure(err.response.data.message);
                        }
                    });

            }
        },
        onSuccess(message) {
            this.success = true;
        },
        onFailure(message) {
            this.error = true;
        },
        setErrors(errors) {
            this.errors = errors;
        },
        clearForm() {
            this.form.user_name = "";
            this.form.user_email = "";
            this.form.topic = "";
            this.form.message = "";
        },
        hasError(fieldName) {
            return (fieldName in this.errors)
        },
        appPath(url) {
            window.laravel + url;
        }
    }
}
</script>
<style scoped>
.contact-text {
    font-size: 14px;
    line-height: 136%;
    color: #676767;
    max-width: 543px;
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
    margin-bottom: 20px;
    padding: 50px 70px;
    background-color: #f7f7f7 !important;
}

.textarea-container button {
    position: absolute;
    top: -104px;
    right: 0px;
}

textarea::-webkit-scrollbar {
    width: 0px;
}
</style>

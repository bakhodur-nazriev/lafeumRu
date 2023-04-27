<template>
    <div class="pa-3 main-block">
        <v-card
            tile
            width="800"
            elevation="0"
            class="mx-auto rounded-lg pa-3"
        >
            <!--  For Small Display  -->
            <v-row class="hidden-sm-and-up">
                <v-col md="10" cols="12 sm-pb-0">
                    <v-text-field
                        solo
                        flat
                        dense
                        clearable
                        single-line
                        hide-details
                        v-model="userData.name"
                        label="Полное имя пользователя*"
                        background-color="grey lighten-2"
                    >
                    </v-text-field>
                </v-col>
                <v-col md="10" cols="12 sm-pb-0">
                    <v-text-field
                        solo
                        flat
                        dense
                        clearable
                        single-line
                        hide-details
                        label="Email"
                        v-model="userData.email"
                        background-color="grey lighten-2"
                    >
                    </v-text-field>
                </v-col>
                <v-col md="10" cols="12 sm-pb-0">
                    <v-text-field
                        solo
                        flat
                        dense
                        clearable
                        single-line
                        hide-details
                        label="Пароль"
                        v-model="userData.password"
                        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                        background-color="grey lighten-2"
                    >
                    </v-text-field>
                </v-col>
                <v-col md="10" cols="12" class="d-flex">
                    <div class="mr-4">
                        <div class="d-sm-block d-md-flex">
                            <v-text-field
                                solo
                                flat
                                dense
                                hide-details
                                type="number"
                                :label="ageAsString"
                                v-model="user.age"
                                class="rounded-lg"
                                placeholder="Возраст"
                                background-color="grey lighten-2"
                            ></v-text-field>
                        </div>
                    </div>

                    <div>
                        <div class="d-sm-block d-md-flex">
                            <v-select
                                solo
                                flat
                                dense
                                hide-details
                                class="rounded-lg"
                                :label="userData.gender"
                                background-color="grey lighten-2"
                            ></v-select>
                        </div>
                    </div>
                </v-col>
                <v-col cols="12" sm="6">
                    <v-textarea
                        flat
                        solo
                        chips
                        rows="3"
                        hide-details
                        label="Chips"
                        background-color="grey lighten-2"
                        placeholder="Что вы предпочитаете делать в свободное время?"
                    ></v-textarea>
                </v-col>
                <v-col cols="12" sm="6" class="text-right">
                    <v-btn class="primary text-capitalize">Сохранить</v-btn>
                </v-col>
            </v-row>

            <!--  For Large Display  -->
            <v-row class="hidden-sm-and-down px-3">
                <form @submit.prevent="updateProfile">
                    <v-col cols="12">
                        <v-avatar size="80">
                            <v-img :src="selectedPhoto" :alt="userData.name"></v-img>
                        </v-avatar>

                        <v-btn
                            depressed
                            color="primary"
                            class="text-capitalize rounded-lg mx-2"
                            :loading="isSelecting"
                            @click="handleFileImport"
                        >
                            Изменить фото
                        </v-btn>

                        <input
                            type="file"
                            class="d-none"
                            ref="uploader"
                            @change="onFileChanged"
                        >
                        <v-btn
                            depressed
                            color="primary"
                            class="text-capitalize rounded-lg"
                            @click="deletePhoto"
                            v-if="selectedFile"
                        >
                            Удалить фото
                        </v-btn>
                    </v-col>
                    <v-col cols="12">
                        <p class="py-1 grey--text caption">Полное имя пользователя*</p>
                        <div class="d-flex">
                            <v-text-field
                                solo
                                flat
                                dense
                                single-line
                                hide-details
                                class="rounded-lg"
                                v-model="user.name"
                                :label="userData.name"
                                placeholder="Имя и фамилия"
                                background-color="grey lighten-2"
                            >
                            </v-text-field>
                        </div>
                    </v-col>
                    <v-col cols="12">
                        <p class="grey--text py-1 caption">Адрес E-mail</p>
                        <v-text-field
                            solo
                            flat
                            dense
                            hide-details
                            :label="userData.email"
                            v-model="user.email"
                            class=" rounded-lg"
                            placeholder="Placeholder"
                            background-color="grey lighten-2"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <p class="grey--text py-1 caption">Пароль</p>
                        <v-text-field
                            solo
                            flat
                            dense
                            hide-details
                            class="rounded-lg"
                            label="Новый пароль"
                            v-model="user.password"
                            background-color="grey lighten-2"
                            :type="showPassword ? 'text' : 'password'"
                            @click:append="showPassword = !showPassword"
                            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <p class="grey--text py-1 caption">Новый пароль</p>
                        <v-text-field
                            solo
                            flat
                            dense
                            hide-details
                            class="rounded-lg"
                            v-model="user.confirmPassword"
                            background-color="grey lighten-2"
                            label="Подтверждение нового пароля"
                            :type="showConfirmPassword ? 'text' : 'password'"
                            @click:append="showConfirmPassword = !showConfirmPassword"
                            :append-icon="showConfirmPassword ? 'mdi-eye' : 'mdi-eye-off'"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <p class="grey--text py-1 caption">Страна</p>
                        <v-autocomplete
                            solo
                            flat
                            dense
                            hide-details
                            ref="country"
                            class="rounded-lg"
                            :items="countries"
                            v-model="user.country"
                            :label="userData.country"
                            placeholder="Выберите страну..."
                            background-color="grey lighten-2"
                        ></v-autocomplete>
                    </v-col>
                    <v-col cols="12" class="d-flex justify-content-between">
                        <div class="mr-4">
                            <p class="grey--text py-1 caption">Возраст</p>
                            <v-text-field
                                solo
                                flat
                                dense
                                hide-details
                                type="number"
                                :label="ageAsString"
                                v-model="user.age"
                                class="rounded-lg"
                                placeholder="Возраст"
                                background-color="grey lighten-2"
                            ></v-text-field>
                        </div>
                        <div class="ml-4">
                            <p class="grey--text py-1 caption">Пол</p>
                            <v-select
                                solo
                                flat
                                dense
                                hide-details
                                class="rounded-lg"
                                :label="userData.gender === null ? 'Не выбрано' : userGender"
                                v-model="user.gender"
                                :items="['Мужской', 'Женский']"
                                background-color="grey lighten-2"
                            ></v-select>
                        </div>
                    </v-col>
                    <v-col cols="12">
                        <p class="grey--text py-1 caption">Хобби</p>
                        <v-textarea
                            flat
                            solo
                            dense
                            rows="3"
                            multiple
                            hide-details
                            v-model="user.hobby"
                            class="rounded-lg"
                            placeholder="Что вы предпочитаете делать в свободное время?"
                            background-color="grey lighten-2"
                        ></v-textarea>
                    </v-col>
                    <v-col cols="12">
                        <v-btn
                            depressed
                            type="submit"
                            color="primary"
                            class="text-capitalize rounded-lg mr-2"
                        >
                            Сохранить
                        </v-btn>
                        <v-btn
                            depressed
                            color="primary"
                            class="text-capitalize rounded-lg ml-2"
                            @click="clearFields"
                        >
                            Отменить
                        </v-btn>
                    </v-col>
                </form>
            </v-row>
        </v-card>
    </div>
</template>

<script>
export default {
    props: ["userData"],
    name: "Profile",
    data() {
        return {
            user: {
                age: 0,
                name: '',
                email: '',
                hobby: '',
                avatar: '',
                gender: '',
                country: '',
                password: '',
                confirmPassword: ''
            },
            showPassword: false,
            showConfirmPassword: false,
            isSelecting: false,
            selectedFile: null,
            countries: []
        }
    },
    computed: {
        selectedPhoto() {
            return this.selectedFile ? URL.createObjectURL(this.selectedFile) : this.userData.avatar;
        },
        userGender() {
            const genderTranslations = {
                'male': 'Мужской',
                'female': 'Женский',
            };

            return genderTranslations[this.userData.gender] || '';
        },
        ageAsString() {
            if (this.user.age)
                return String(this.userData.age);
        }
    },
    methods: {
        handleFileImport() {
            this.isSelecting = true;

            window.addEventListener('focus', () => {
                this.isSelecting = false;
            }, {once: true});

            this.$refs.uploader.click();
        },
        onFileChanged(e) {
            this.selectedFile = e.target.files[0];
        },
        deletePhoto() {
            this.selectedFile = null;
        },
        updateProfile() {
            const formData = new FormData();

            if (this.user.gender === 'Мужской') {
                this.user.gender = 'male';
            } else if (this.user.gender === 'Женский') {
                this.user.gender = 'female';
            } else {
                this.user.gender = '';
            }

            if (this.user.age) {
                formData.append('age', this.user.age || this.userData.age);
            }
            if (this.user.gender) {
                formData.append('gender', this.user.gender || this.userData.gender);
            }
            if (this.user.hobby) {
                formData.append('hobby', this.user.hobby || this.userData.hobby);
            }

            if (this.user.password) {
                formData.append('password', this.user.password || this.userData.password);
            }
            if (this.user.confirmPassword) {
                formData.append('confirm_password', this.user.confirmPassword || this.userData.confirmPassword);
            }
            if (this.user.country) {
                formData.append('country', this.user.country || this.userData.country);
            }

            formData.append('avatar', this.selectedFile || this.userData.avatar);
            formData.append('name', this.user.name || this.userData.name);
            formData.append('email', this.user.email || this.userData.email);

            axios
                .post('/api/users/' + this.userData.id, formData, {
                    headers: {
                        "content-type": "multipart/form-data",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                            .content,
                    },
                })
                .then(res => {
                    window.location.href = '/profile';
                    console.log(res.data);
                })
                .catch(err => {
                    console.log(err.response.data);
                });
        },
        clearFields() {
        },
        getCountries() {
            fetch('https://restcountries.com/v3.1/all')
                .then(response => response.json())
                .then((res) => {
                    this.countries = res.map(country => country.translations.rus.common);
                })
                .catch(error => console.error(error));
        },
    },
    mounted() {
        this.getCountries();
        console.log(this.userData);
    }
}
</script>

<style scoped>
@media (max-width: 767px) {
    .main-block {
        max-width: 100%;
    }
}

@media (min-width: 768px) {
    .main-block {
        max-width: 100%;
    }
}
</style>

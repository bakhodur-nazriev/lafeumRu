<template>
    <div class="pa-3 main-block">
        <v-card
            tile
            width="800"
            elevation="0"
            class="mx-auto rounded-lg pa-5"
        >
            <!--  For Small Display  -->
            <v-row class="hidden-md-and-up">
                <form @submit.prevent="updateProfile">
                    <v-col cols="10" class="pb-0 d-flex align-items-center" sm="10">
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
                    <v-col cols="12 pb-0">
                        <p class="py-1 grey--text caption">Полное имя пользователя*</p>
                        <v-text-field
                            solo
                            flat
                            dense
                            clearable
                            single-line
                            hide-details
                            v-model="user.name"
                            :label="userData.name"
                            background-color="grey lighten-2"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12 pb-0">
                        <p class="grey--text py-1 caption">Адрес E-mail</p>
                        <v-text-field
                            solo
                            flat
                            dense
                            clearable
                            single-line
                            hide-details
                            v-model="user.email"
                            :label="userData.email"
                            background-color="grey lighten-2"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12 pb-0">
                        <p class="grey--text py-1 caption">Пароль</p>
                        <v-text-field
                            solo
                            flat
                            dense
                            single-line
                            hide-details
                            label="Новый пароль"
                            v-model="user.password"
                            background-color="grey lighten-2"
                            :type="showPassword ? 'text' : 'password'"
                            @click:append="showPassword = !showPassword"
                            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12 pb-0">
                        <p class="grey--text py-1 caption">Новый пароль</p>
                        <v-text-field
                            solo
                            flat
                            dense
                            single-line
                            hide-details
                            v-model="user.confirmPassword"
                            background-color="grey lighten-2"
                            label="Подтверждение нового пароля"
                            :type="showConfirmPassword ? 'text' : 'password'"
                            @click:append="showConfirmPassword = !showConfirmPassword"
                            :append-icon="showConfirmPassword ? 'mdi-eye' : 'mdi-eye-off'"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12 pb-0">
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
                    <v-col cols="12 pb-0 d-flex justify-content-between">
                        <div class="mr-4">
                            <p class="grey--text py-1 caption">Возраст</p>
                            <v-text-field
                                solo
                                flat
                                dense
                                min="8"
                                max="100"
                                type="number"
                                hide-details
                                :rules="ageRules"
                                class="rounded-lg"
                                v-model="user.age"
                                :label="ageAsString"
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
                    <v-col cols="12 pb-0">
                        <p class="grey--text py-1 caption">Хобби</p>
                        <v-textarea
                            flat
                            solo
                            chips
                            rows="3"
                            hide-details
                            v-model="hobbyInput"
                            placeholder="Что вы предпочитаете делать в свободное время?"
                            background-color="grey lighten-2"
                        >
                        </v-textarea>
                    </v-col>
                    <v-col cols="12 text-right">
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
                            @click="resetForm"
                        >
                            Отменить
                        </v-btn>
                    </v-col>
                </form>
            </v-row>

            <!--  For Large Display  -->
            <v-row class="hidden-sm-and-down px-3 mt-0">
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
                            class=" rounded-lg"
                            v-model="user.email"
                            :label="userData.email"
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
                    <v-col cols="12 d-flex justify-content-between">
                        <div class="mr-4">
                            <p class="grey--text py-1 caption">Возраст</p>
                            <v-text-field
                                solo
                                flat
                                dense
                                min="8"
                                hide-details
                                type="number"
                                :rules="ageRules"
                                class="rounded-lg"
                                v-model="user.age"
                                :label="ageAsString"
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
                            class="rounded-lg"
                            v-model="hobbyInput"
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
                            @click="resetForm"
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
                age: '',
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
            countries: [],
            ageRules: [
                (v) => !!v || 'Укажите возраст.',
                (v) => /^\d+$/.test(v) || 'Возраст должен быть положительным целым числом.',
            ],
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
            if (this.userData.age)
                return String(this.userData.age);
        },
        hobbyInput: {
            get(){
                if (this.user.hobby.legnth <= 0){
                    return this.user.hobby;
                } else {
                    return this.userData.hobby;
                }
            },
            set(value) {
                this.user.hobby = value;
            }
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
        resetForm() {
            const propertiesToReset = ['age', 'name', 'hobby', 'email', 'avatar', 'gender', 'country', 'password', 'confirmPassword'];

            for (const property of propertiesToReset) {
                if (this.user[property] !== '') {
                    this.user[property] = '';
                }
            }

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
    watch: {
        hobbyInput(newValue, oldValue) {
            if (!newValue) {
                this.hobbyInput = '';
            }
        }
    },
    mounted() {
        this.getCountries();
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

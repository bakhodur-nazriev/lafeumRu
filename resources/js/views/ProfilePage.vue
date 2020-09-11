<template>
    <v-main class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-card class="pa-2" align="center" max-width="650">
                    <v-card-title class="align-items-start justify-center">
                        <v-col md="4" sm="4">
                            <v-img
                                :src="user.avatar"
                                alt="avatar"
                                style="border-radius: 50%; border: solid 4px #04718c;"
                            >
                                <div
                                    class="change-avatar"
                                    @click="updatingAvatar = true"
                                >
                                    <p class="text-center mb-0">
                                        <v-icon dark>mdi-camera</v-icon>
                                    </p>
                                </div>
                            </v-img>
                        </v-col>
                    </v-card-title>
                    <v-card-text class="py-0">
                        <v-row align="center">
                            <v-col md="6">
                                <label class="w-100 text-start font-weight-bold ">Имя</label>
                                <div class="d-flex">
                                    <v-text-field
                                        disabled
                                        hide-details
                                        class="mb-4 pt-0"
                                        :label="user.name"
                                    ></v-text-field>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn
                                                icon
                                                text
                                                v-on="on"
                                                color="primary"
                                                @click="updatingName = true"
                                            >
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Изменить имя</span>
                                    </v-tooltip>
                                </div>
                            </v-col>
                            <v-col md="6">
                                <label class="w-100 text-start font-weight-bold">Email</label>
                                <div class="d-flex">
                                    <v-text-field
                                        disabled
                                        hide-details
                                        class="mb-4 pt-0"
                                        :label="user.email"
                                    ></v-text-field>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn
                                                icon
                                                text
                                                v-on="on"
                                                color="primary"
                                                @click="updatingEmail = true"
                                            >
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Изменить email</span>
                                    </v-tooltip>
                                </div>
                            </v-col>
                            <v-col md="6">
                                <label class="w-100 text-start font-weight-bold">Пароль</label>
                                <div class="d-flex">
                                    <v-text-field
                                        disabled
                                        hide-details
                                        class="mb-4 pt-0"
                                        :label="user.password"
                                    ></v-text-field>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn
                                                icon
                                                text
                                                v-on="on"
                                                color="primary"
                                                @click="updatingPassword = true"
                                            >
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Изменить пароль</span>
                                    </v-tooltip>
                                </div>
                            </v-col>
                            <v-col md="6">
                                <label class="w-100 text-start font-weight-bold">Страна</label>
                                <div class="d-flex">
                                    <v-text-field
                                        disabled
                                        hide-details
                                        class="mb-4 pt-0"
                                        :label="user.country"
                                    ></v-text-field>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn
                                                icon
                                                text
                                                v-on="on"
                                                color="primary"
                                                @click="updatingCountry = true"
                                            >
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Изменить страну</span>
                                    </v-tooltip>
                                </div>
                            </v-col>
                            <v-col md="6">
                                <label class="w-100 text-start font-weight-bold">Возраст</label>
                                <div class="d-flex">
                                    <v-text-field
                                        disabled
                                        hide-details
                                        class="mb-4 pt-0"
                                        :label="user.age"
                                    ></v-text-field>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn
                                                icon
                                                text
                                                v-on="on"
                                                color="primary"
                                                @click="updatingAge = true"
                                            >
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Изменить возрасть</span>
                                    </v-tooltip>
                                </div>
                            </v-col>
                            <v-col md="6">
                                <label class="w-100 text-start font-weight-bold">Пол</label>
                                <div class="d-flex">
                                    <v-text-field
                                        disabled
                                        hide-details
                                        class="mb-4 pt-0"
                                        :label="user.gender"
                                    ></v-text-field>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn
                                                icon
                                                text
                                                v-on="on"
                                                color="primary"
                                                @click="updatingGender = true"
                                            >
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Изменить пол</span>
                                    </v-tooltip>
                                </div>
                            </v-col>
                            <v-col md="12">
                                <label class="w-100 text-start font-weight-bold">Хобби</label>
                                <div class="d-flex">
                                    <v-textarea
                                        disabled
                                        hide-details
                                        class="mb-4 pt-0"
                                        :value="user.hobby"
                                    />
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-btn
                                                icon
                                                text
                                                v-on="on"
                                                color="primary"
                                                @click="updatingHobby = true"
                                            >
                                                <v-icon>mdi-pencil</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Изменить хобби</span>
                                    </v-tooltip>
                                </div>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-row>
        </v-container>

        <!--Update Profile Password-->
        <v-dialog v-model="showDialog" width="600">
            <v-card>
                <v-form ref="form" @submit="updateProfile">
                    <v-card-title class="primary white--text">
                        {{ formTitle }}
                    </v-card-title>

                    <v-container class="pb-2" v-if="updatingAvatar">
                        <v-file-input
                            outlined
                            hide-details
                            prepend-icon=""
                            label="Загрузить фото"
                            prepend-inner-icon="mdi-camera"
                            v-model="profileToUpdate.avatar"
                        />
                    </v-container>
                    <v-container class="pb-2" v-if="updatingName">
                        <v-text-field
                            outlined
                            hide-details
                            :label="this.user.name"
                            v-model="profileToUpdate.name"
                        />
                    </v-container>
                    <v-container class="pb-2" v-if="updatingEmail">
                        <v-text-field
                            outlined
                            hide-details
                            :label="this.user.email"
                            v-model="profileToUpdate.email"
                            :rules="[rules.required, rules.email]"
                        />
                    </v-container>
                    <v-container class="pb-2" v-if="updatingCountry">
                        <v-text-field
                            outlined
                            hide-details
                            :label="this.user.country"
                            v-model="profileToUpdate.country"
                        />
                    </v-container>
                    <v-container class="pb-2" v-if="updatingAge">
                        <v-text-field
                            outlined
                            :label="this.user.age"
                            v-model="profileToUpdate.age"
                            :rules="[rules.required, rules.age]"
                        />
                    </v-container>
                    <v-container class="pb-2" v-if="updatingGender">
                        <v-text-field
                            outlined
                            hide-details
                            :label="this.user.gender"
                            v-model="profileToUpdate.gender"
                        />
                    </v-container>
                    <v-container class="pb-2" v-if="updatingHobby">
                        <v-textarea
                            outlined
                            hide-details
                            :label="this.user.hobby"
                            v-model="profileToUpdate.hobby"
                        />
                    </v-container>
                    <v-container v-if="updatingPassword">
                        <v-text-field
                            outlined
                            hide-details
                            class="mb-4"
                            label="Новый пароль"
                            v-model="profileToUpdate.password"
                            @click:append="showPass = !showPass"
                            :type="showPass ? 'text' : 'password'"
                            :rules="[rules.required, rules.getMin(3)]"
                            :append-icon="showPass ? 'mdi-eye' : 'mdi-eye-off'"
                        />
                        <v-text-field
                            outlined
                            hide-details
                            v-model="profileToUpdate.passwordConfirmation"
                            :append-icon="showPass ? 'mdi-eye' : 'mdi-eye-off'"
                            :rules="[
                                rules.getPasswordConfirm(
                                    profileToUpdate.password
                                )
                            ]"
                            :type="showPass ? 'text' : 'password'"
                            label="Подтверждение нового пароля"
                            @click:append="showPass = !showPass"
                        />
                    </v-container>

                    <v-card-actions>
                        <v-spacer/>
                        <v-btn dark color="primary" type="submit">Сохранить</v-btn>
                        <v-btn
                            dark
                            color="error"
                            type="button"
                            @click="showDialog = false"
                        >
                            Закрыть
                        </v-btn>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>
    </v-main>
</template>

<script>
    import rules from "../validation-rules";

    export default {
        data() {
            return {
                profileToUpdate: {
                    age: null,
                    name: null,
                    hobby: null,
                    email: null,
                    avatar: null,
                    gender: null,
                    country: null,
                    password: null
                },
                rules,
                showPass: false,
                updatingAge: false,
                updatingName: false,
                updatingEmail: false,
                updatingHobby: false,
                updatingAvatar: false,
                updatingGender: false,
                updatingCountry: false,
                updatingPassword: false,
                user: window.Laravel.auth
            };
        },
        methods: {
            updateProfile(e) {
                e.preventDefault();

                const validForm = this.$refs.form.validate();

                if (!validForm) return;

                const formData = new FormData();

                const {avatar, name, email, password, country, age, gender, hobby} = this.profileToUpdate;

                if (this.updatingAvatar && avatar instanceof File) {
                    formData.append("avatar", avatar);
                }

                if (this.updatingName) {
                    formData.append("name", name);
                }

                if (this.updatingEmail) {
                    formData.append("email", email);
                }

                if (this.updatingCountry) {
                    formData.append("country", country);
                }

                if (this.updatingAge) {
                    formData.append("age", age);
                }

                if (this.updatingGender) {
                    formData.append("gender", gender);
                }

                if (this.updatingHobby) {
                    formData.append("hobby", hobby);
                }

                if (this.updatingPassword) {
                    formData.append("password", password);
                }

                formData.append("_method", "put");

                axios
                    .post("/api/users/" + this.user.id, formData, {
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(({data}) => {
                        this.showDialog = false;
                        this.user = data;
                        Event.fire("profileUpdated", data);
                    })
                    .catch(err => console.log(err));
            },
        },
        computed: {
            showDialog: {
                get() {
                    return (
                        this.updatingAvatar ||
                        this.updatingName ||
                        this.updatingEmail ||
                        this.updatingCountry ||
                        this.updatingAge ||
                        this.updatingGender ||
                        this.updatingHobby ||
                        this.updatingPassword
                    );
                },
                set(v) {
                    if (!v) {
                        this.updatingAvatar = false;
                        this.updatingName = false;
                        this.updatingEmail = false;
                        this.updatingCountry = false;
                        this.updatingAge = false;
                        this.updatingGender = false;
                        this.updatingHobby = false;
                        this.updatingPassword = false;
                    }
                }
            },
            formTitle() {
                let baseTitle = "Изменение";

                if (this.updatingAvatar) {
                    baseTitle += " аватара ";
                }

                if (this.updatingName) {
                    baseTitle += " имени ";
                }

                if (this.updatingEmail) {
                    baseTitle += " email-а ";
                }

                if (this.updatingCountry) {
                    baseTitle += " страну ";
                }

                if (this.updatingAge) {
                    baseTitle += " возраста ";
                }

                if (this.updatingGender) {
                    baseTitle += " пола ";
                }

                if (this.updatingHobby) {
                    baseTitle += " хобби ";
                }

                if (this.updatingPassword) {
                    baseTitle += " пароля ";
                }

                return baseTitle;
            }
        }
    };
</script>

<style>
    .change-avatar {
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        position: relative;
        opacity: 0;
        height: 100%;
        cursor: pointer;
        background-color: rgba(32, 33, 36, 0.6);
    }

    .change-avatar:hover {
        opacity: 0.8;
        transition: 0.2s ease-in;
    }
</style>

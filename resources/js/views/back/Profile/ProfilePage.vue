<template>
    <v-main class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-col class="d-flex justify-center">
                    <v-sheet
                        width="267"
                        rounded="lg"
                        class="mr-4"
                        min-height="70vh"
                    >
                        <v-list flat rounded>
                            <v-col class="d-flex align-center p-3">
                                <v-avatar size="60">
                                    <img :src="user.avatar">
                                </v-avatar>
                                <div class="ml-3">
                                    <h5 class="my-1">{{ user.name }}</h5>
                                    <h6 class="my-1 grey--text">{{ user.name }}</h6>
                                </div>
                            </v-col>

                            <v-divider class="m-3"></v-divider>

                            <v-list-item-group
                                color="primary"
                                class="px-2"
                            >
                                <v-list-item
                                    v-for="(item, i) in items"
                                    :key="i"
                                >
                                    <v-list-item-icon>
                                        <v-icon v-text="item.icon"></v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title v-text="item.text"></v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-item-group>

                            <v-divider class="m-3"></v-divider>

                            <v-col class="d-flex align-center">
                                <v-icon>mdi-logout</v-icon>
                                <h6 class="ml-2">Выход</h6>
                            </v-col>
                        </v-list>
                    </v-sheet>
                    <v-form ref="form" @submit="updateProfile">
                        <v-sheet
                            min-height="70vh"
                            class="ml-4 p-5"
                            rounded="lg"
                            width="858"
                        >
                            <v-col cols="12">
                                <h6 class="grey--text font-weight-regular mb-4">Изменить фотографию профиля</h6>
                                <v-avatar class="mr-5" size="100">
                                    <img :src="user.avatar">
                                </v-avatar>
                                <v-btn
                                    large
                                    depressed
                                    height="52"
                                    type="submit"
                                    color="primary"
                                    class="mr-3 rounded-lg"
                                    @click="updatingAvatar = true"
                                >
                                    Изменить аватарку
                                </v-btn>
                                <v-btn
                                    large
                                    depressed
                                    height="52"
                                    color="primary"
                                    class="rounded-lg"
                                    @click="deletingAvatar = true"
                                >
                                    Удалить
                                </v-btn>
                            </v-col>
                            <v-col cols="12">
                                <label class="w-100 grey--text text-start font-weight-regular mb-2">Имя
                                    пользователя*</label>
                                <div class="d-flex">
                                    <v-text-field
                                        dense
                                        filled
                                        rounded
                                        clearable
                                        :label="user.name"
                                        class="rounded-lg mr-4"
                                        v-model="profileToUpdate.name"
                                    />
                                    <v-btn
                                        large
                                        depressed
                                        height="52"
                                        color="primary"
                                        class="rounded-lg"
                                        @click=""
                                    >
                                        Сохранить изменения
                                    </v-btn>
                                </div>
                            </v-col>
                            <v-col cols="12">
                                <label class="w-100 grey--text text-start font-weight-regular mb-2">Адрес
                                    E-mail*</label>
                                <div class="d-flex">
                                    <v-text-field
                                        dense
                                        filled
                                        rounded
                                        clearable
                                        :label="user.email"
                                        class="rounded-lg mr-4"
                                        v-model="profileToUpdate.email"
                                    ></v-text-field>
                                    <v-btn
                                        large
                                        depressed
                                        height="52"
                                        type="submit"
                                        color="primary"
                                        class="rounded-lg"
                                    >
                                        Сохранить изменения
                                    </v-btn>
                                </div>
                            </v-col>
                            <v-col cols="12">
                                <label class="w-100 grey--text text-start font-weight-regular mb-2">Пароль</label>
                                <div class="d-flex">
                                    <v-text-field
                                        filled
                                        rounded
                                        clearable
                                        :label="user.password"
                                        class="rounded-lg mr-4"
                                        v-model="profileToUpdate.password"
                                    ></v-text-field>
                                    <v-btn
                                        large
                                        depressed
                                        height="52"
                                        type="submit"
                                        color="primary"
                                        class="rounded-lg"
                                    >
                                        Сохранить изменения
                                    </v-btn>
                                </div>
                            </v-col>

                            <!--                        <v-row align="center">
                                                        <v-col md="6">
                                                            <label class="w-100 text-start font-weight-bold">Имя</label>
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
                                                    </v-row>-->
                        </v-sheet>
                    </v-form>

                </v-col>
            </v-row>
        </v-container>

        <!--Update Profile-->
        <v-dialog v-model="showDialog" width="600">
            <v-card>
                <v-form ref="form" @submit="updateProfile">
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
                        <v-btn dark color="primary" type="submit">Сохранить</v-btn>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>
    </v-main>
</template>

<script>
import rules from "../../../validation-rules";
import ProfileEdit from "./ProfileEdit";
import ProfileFavorites from "./ProfileFavorites";

export default {
    data() {
        return {
            profileToUpdate: {
                age: null,
                name: null,
                email: null,
                avatar: null,
                password: null
            },
            rules,
            showPass: false,
            updatingName: false,
            updatingEmail: false,
            updatingAvatar: false,
            updatingPassword: false,
            user: window.Laravel.auth,
            items: [
                {
                    icon: "mdi-account-circle",
                    text: "Редактировать",
                    link: ProfileEdit
                },
                {
                    icon: "mdi-star",
                    text: "Избранное",
                    link: ProfileFavorites
                },
                {
                    icon: "mdi-settings",
                    text: "Настройки",
                },
            ],
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

<style scoped>
* {
    text-transform: none !important;
}

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

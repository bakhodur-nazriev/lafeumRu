<template>
    <v-content class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-card class="pa-2" align="center" max-width="550">
                    <v-card-title class="align-items-start justify-center">
                        <v-col md="12" sm="12" align="center">
                            <span class="headline font-weight-bold"
                                >Мой профиль</span
                            >
                        </v-col>

                        <v-col md="4" sm="4">
                            <v-img
                                :src="user.avatar"
                                alt="avatar"
                                style="border-radius: 50%; border: solid 4px #04718c;"
                            >
                                <div
                                    class="change-avatar"
                                    @click="dialogChangeAvatar = true"
                                >
                                    <p class="text-center mb-0">
                                        <v-icon dark>mdi-camera</v-icon>
                                    </p>
                                </div>
                            </v-img>
                        </v-col>
                    </v-card-title>
                    <v-card-text class="py-0">
                        <label class="mb-0 d-flex subtitle-1 font-weight-bold"
                            >Имя профиля</label
                        >
                        <v-row align="center">
                            <v-col class="pt-0 d-flex" md="12">
                                <v-text-field
                                    class="mb-4 pt-0"
                                    hide-details
                                    :label="user.name"
                                    disabled
                                ></v-text-field>
                                <v-tooltip top>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            v-on="on"
                                            icon
                                            color="primary"
                                            text
                                            @click="dialogChangeName = true"
                                        >
                                            <v-icon>mdi-pencil</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Изменить имя</span>
                                </v-tooltip>
                            </v-col>
                        </v-row>

                        <label class="mb-0 d-flex subtitle-1 font-weight-bold"
                            >Email профиля</label
                        >
                        <v-row align="center">
                            <v-col class="pt-0 d-flex" md="12">
                                <v-text-field
                                    class="mb-4 pt-0"
                                    hide-details
                                    disabled
                                    :label="this.user.email"
                                ></v-text-field>
                                <v-tooltip top>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            v-on="on"
                                            icon
                                            color="primary"
                                            text
                                            @click="dialogChangeEmail = true"
                                        >
                                            <v-icon>mdi-pencil</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Изменить email</span>
                                </v-tooltip>
                            </v-col>
                        </v-row>

                        <label class="mb-0 d-flex subtitle-1 font-weight-bold"
                            >Пароль профиля</label
                        >
                        <v-row align="center">
                            <v-col class="pt-0 d-flex" md="12">
                                <v-text-field
                                    class="mb-4"
                                    hide-details
                                    disabled
                                    :label="this.user.password"
                                ></v-text-field>
                                <v-tooltip top>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            v-on="on"
                                            icon
                                            color="primary"
                                            text
                                            @click="dialogChangePassword = true"
                                        >
                                            <v-icon>mdi-pencil</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Изменить пароль</span>
                                </v-tooltip>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-row>
        </v-container>
        <!-- Update Avatar -->
        <v-dialog v-model="dialogChangeAvatar" width="600">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить Аватар
                </v-card-title>
                <v-container>
                    <v-file-input
                        prepend-icon=""
                        prepend-inner-icon="mdi-camera"
                        outlined
                        label="Загрузить фото"
                        hide-details
                        :rules="rules"
                        name="updatedProfileAvatar"
                        v-model="profileToUpdate.avatar"
                    />
                </v-container>
                <v-card-actions>
                    <v-spacer />
                    <v-btn dark color="primary" @click="updateAvatar()"
                        >Сохранить</v-btn
                    >
                    <v-btn
                        dark
                        color="error"
                        @click="() => (dialogChangeAvatar = false)"
                        >Закрыть</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!--Update Profile Name-->
        <v-dialog v-model="dialogChangeName" width="600">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить Имя
                </v-card-title>
                <v-container>
                    <v-text-field
                        :label="this.user.name"
                        hide-details
                        outlined
                        name="name"
                        v-model="profileToUpdate.name"
                    />
                </v-container>
                <v-card-actions>
                    <v-spacer />
                    <v-btn dark color="primary" @click="updateProfileName()"
                        >Сохранить</v-btn
                    >
                    <v-btn
                        dark
                        color="error"
                        @click="() => (dialogChangeName = false)"
                        >Закрыть</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!--Update Profile Email-->
        <v-dialog v-model="dialogChangeEmail" width="600">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить Email
                </v-card-title>
                <v-container class="pb-0">
                    <v-text-field
                        :label="this.user.email"
                        :rules="[rules.required, rules.email]"
                        outlined
                        v-model="profileToUpdate.email"
                    />
                </v-container>
                <v-card-actions>
                    <v-spacer />
                    <v-btn dark color="primary" @click="updateProfileEmail()"
                        >Сохранить</v-btn
                    >
                    <v-btn
                        dark
                        color="error"
                        @click="() => (dialogChangeEmail = false)"
                        >Закрыть</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!--Update Profile Password-->
        <v-dialog v-model="dialogChangePassword" width="600">
            <v-card>
                <v-form ref="passwordForm" @submit="updateProfilePassword">
                    <v-card-title class="primary white--text">
                        Изменить Пароль
                    </v-card-title>
                    <v-container>
                        <v-text-field
                            v-model="profileToUpdate.password"
                            :append-icon="showPass ? 'mdi-eye' : 'mdi-eye-off'"
                            :rules="[rules.required, rules.min]"
                            :type="showPass ? 'text' : 'password'"
                            label="Новый пароль"
                            @click:append="showPass = !showPass"
                            outlined
                        />
                        <v-text-field
                            v-model="profileToUpdate.passwordConfirmation"
                            :append-icon="showPass ? 'mdi-eye' : 'mdi-eye-off'"
                            :rules="[rules.confirmed]"
                            :type="showPass ? 'text' : 'password'"
                            label="Подтверждение пароля"
                            @click:append="showPass = !showPass"
                            outlined
                        />
                    </v-container>
                    <v-card-actions>
                        <v-spacer />
                        <v-btn dark color="primary" type="submit"
                            >Сохранить</v-btn
                        >
                        <v-btn
                            dark
                            color="error"
                            type="button"
                            @click="dialogChangePassword = false"
                            >Закрыть</v-btn
                        >
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>
    </v-content>
</template>

<script>
export default {
    data() {
        return {
            profileToUpdate: {
                email: null,
                name: null,
                password: null,
                avatar: null
            },
            showPass: false,
            user: window.Laravel.auth,
            dialogChangeAvatar: false,
            dialogChangeName: false,
            dialogChangeEmail: false,
            dialogChangePassword: false,
            rules: {
                required: value => !!value || "Обязательное поле",
                min: value => value.length >= 3 || "Минимум 3 символов",
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return pattern.test(value) || "Invalid e-mail.";
                },
                confirmed: value =>
                    value === this.profileToUpdate.password ||
                    "Пароли не совпадают"
            }
        };
    },
    mounted() {},
    methods: {
        updateAvatar() {
            const { avatar } = this.profileToUpdate;
            if (!avatar) return;

            const formData = new FormData();
            formData.append("avatar", avatar);

            this.updateProfile(formData);
        },
        updateProfileName() {
            const { name } = this.profileToUpdate;
            if (!name) return;

            const formData = new FormData();
            formData.append("name", name);

            this.updateProfile(formData);
        },
        updateProfileEmail() {
            const { email } = this.profileToUpdate;
            if (!email) return;

            const formData = new FormData();
            formData.append("email", email);

            this.updateProfile(formData);
        },
        updateProfilePassword(e) {
            e.preventDefault();

            const validForm = this.$refs.passwordForm.validate();

            if (!validForm) return;

            const { password } = this.profileToUpdate;
            if (!password) return;

            const formData = new FormData();
            formData.append("password", password);

            this.updateProfile(formData);
        },
        updateProfile(formData) {
            formData.append("_method", "put");
            axios
                .post("/api/users/" + this.user.id, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(({ data }) => {
                    this.resetDialogs();
                    this.user = data;
                    Event.fire("profileUpdated", data);
                })
                .catch(err => console.log(err));
        },
        resetDialogs() {
            this.dialogChangeEmail = false;
            this.dialogChangeName = false;
            this.dialogChangeAvatar = false;
            this.dialogChangePassword = false
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

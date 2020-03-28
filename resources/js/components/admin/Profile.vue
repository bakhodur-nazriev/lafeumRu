<template>
    <v-content class="pa-0">
        <v-container>
            <v-card class="pa-2" justify="center">
                <v-card-title class="justify-space-between align-items-start">
                    <v-row justify="start">
                        <v-col md="12" align="center">
                            <span class="headline font-weight-bold">Мой профиль</span>
                        </v-col>
                        <v-col md="3" align="center">
                            <v-avatar size="120" tile>
                                <img :src="'/img/avatars/' + this.user.avatar">
                            </v-avatar>
                            <v-btn color="primary">Изменить аватар</v-btn>
                        </v-col>
                    </v-row>

                </v-card-title>
                <v-card-text class="py-0">
                    <label class="subtitle-1 font-weight-bold ml-3 mb-1">Имя профилья</label>
                    <v-row align="center">
                        <v-col class="mx-3 pt-0" md="5">
                            <v-text-field
                                class="mb-4 pt-0"
                                hide-details
                                :label="this.user.name"
                            ></v-text-field>
                        </v-col>
                        <v-col md="1" class="pl-0">
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        color="primary"
                                        v-on="on"
                                    >
                                        <v-icon>mdi-pencil</v-icon>
                                    </v-btn>
                                </template>
                                <span>Изменить Имя</span>
                            </v-tooltip>
                        </v-col>
                    </v-row>

                    <label class="subtitle-1 font-weight-bold ml-3 mb-1">Email профилья</label>
                    <v-row align="center">
                        <v-col class="mx-3 pt-0" md="5">
                            <v-text-field
                                class="mb-4 pt-0"
                                hide-details
                                :label="this.user.email"
                            ></v-text-field>
                        </v-col>
                        <v-col md="1" class="pl-0">
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        color="primary"
                                        v-on="on"
                                    >
                                        <v-icon>mdi-pencil</v-icon>
                                    </v-btn>
                                </template>
                                <span>Изменить Имя</span>
                            </v-tooltip>
                        </v-col>
                    </v-row>

                    <label class="subtitle-1 font-weight-bold ml-3 mb-1">Пароль профилья</label>
                    <v-row align="center">
                        <v-col class="mx-3 pt-0" md="5">
                            <v-text-field
                                class="mb-4"
                                hide-details
                                :label="this.user.password"
                            ></v-text-field>
                        </v-col>
                        <v-col md="1" class="pl-0">
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        color="primary"
                                        v-on="on"
                                    >
                                        <v-icon>mdi-pencil</v-icon>
                                    </v-btn>
                                </template>
                                <span>Изменить Имя</span>
                            </v-tooltip>
                        </v-col>
                    </v-row>

                    <label class="subtitle-1 font-weight-bold ml-3 mb-1">Роль профилья</label>
                    <v-row align="center">
                        <v-col class="mx-3 pt-0" md="5">
                            <v-text-field
                                class="mb-4"
                                hide-details
                                :label="this.user.role"
                            ></v-text-field>
                        </v-col>
                        <v-col md="1" class="pl-0">
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        color="primary"
                                        v-on="on"
                                    >
                                        <v-icon>mdi-pencil</v-icon>
                                    </v-btn>
                                </template>
                                <span>Изменить Имя</span>
                            </v-tooltip>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-container>
        <!-- Update Item Dialog -->
        <v-dialog v-if="profileToUpdate" v-model="profileToUpdate" width="700px">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить профиль
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-text-field
                                outlined
                                label="Изменить имя"
                                v-model="profileToUpdate.name"
                            ></v-text-field>
                            <v-text-field
                                outlined
                                label="Изменить email"
                                v-model="profileToUpdate.email"
                            ></v-text-field>
                            <v-file-input
                                outlined
                                name="photo"
                                label="Изменить фото"
                                prepend-icon=""
                                prepend-inner-icon="mdi-camera"
                                v-model="profileToUpdate.photo"
                            >
                            </v-file-input>
                            <v-text-field
                                outlined
                                label="Изменить пароль"
                                v-model="profileToUpdate.email"
                            ></v-text-field>
                            <v-text-field
                                outlined
                                label="Изменить повторите"
                                v-model="profileToUpdate.email"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="updateProfile()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="profileToUpdate = false">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-content>
</template>

<script>
    export default {
        data() {
            return {
                profileToUpdate: null,
                user: window.Laravel.auth,
            }
        },
        mounted() {
            // console.log(this.user.roles);
        },
        methods: {
            appendIconCallback() {
                alert("click:append");
            },
            updateProfile() {
                const formData = new FormData();
                formData.append("name", this.profileToUpdate.name);
                formData.append("email", this.profileToUpdate.email);
                formData.append("avatar", this.profileToUpdate.email);
                formData.append("password", this.profileToUpdate.email);
                formData.append("_method", "put");
                axios.post("/api/users/" + this.profileToUpdate.id, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                }).then(res => {
                    this.profileToUpdate = false;
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>

<template>
    <div class="pa-3 main-block">
        <v-card
            tile
            width="800"
            elevation="1"
            class="mx-auto rounded-lg pa-3"
        >
            <!--  For Small Display  -->
            <v-row class="hidden-sm-and-up">
                <v-col
                    md="10"
                    cols="12 sm-pb-0"
                >
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
                <v-col
                    md="10"
                    cols="12 sm-pb-0"
                >
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
                <v-col
                    md="10"
                    cols="12 sm-pb-0"
                >
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
                <v-col
                    md="10"
                    cols="12"
                    class="d-flex"
                >
                    <div class="mr-4">
                        <div class="d-sm-block d-md-flex">
                            <v-text-field
                                solo
                                flat
                                dense
                                hide-details
                                type="number"
                                :label="userData.age"
                                v-model="userData.age"
                                class="rounded-lg"
                                placeholder="Возрасть"
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
                    <v-select
                        flat
                        solo
                        chips
                        multiple
                        hide-details
                        :items="items"
                        label="Chips"
                        background-color="grey lighten-2"
                    ></v-select>
                </v-col>
                <v-col
                    cols="12"
                    sm="6"
                    class="text-right"
                >
                    <v-btn class="primary text-capitalize">Сохранить</v-btn>
                </v-col>
            </v-row>

            <!--  For Large Display  -->
            <v-row class="hidden-sm-and-down px-3">
                <v-col md="8 pb-0" cols="12">
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
                <v-col md="8" cols="12">
                    <div>
                        <p class="py-1 grey--text caption">Полное имя пользователя*</p>
                    </div>
                    <v-col class="d-sm-block d-md-flex pa-0">
                        <v-text-field
                            solo
                            flat
                            dense
                            single-line
                            hide-details
                            :label="userData.name"
                            class="rounded-lg"
                            placeholder="Placeholder"
                            background-color="grey lighten-2"
                        ></v-text-field>
                    </v-col>
                </v-col>
                <v-col md="8" cols="12">
                    <div>
                        <p class="grey--text py-1 caption">Адрес E-mail</p>
                    </div>
                    <div class="d-sm-block d-md-flex">
                        <v-text-field
                            solo
                            flat
                            dense
                            hide-details
                            :label="userData.email"
                            class=" rounded-lg"
                            placeholder="Placeholder"
                            background-color="grey lighten-2"
                        ></v-text-field>
                    </div>
                </v-col>
                <v-col md="8" cols="12">
                    <div>
                        <p class="grey--text py-1 caption">Пароль</p>
                    </div>
                    <div class="d-sm-block d-md-flex">
                        <v-text-field
                            solo
                            flat
                            dense
                            hide-details
                            :label="userData.password"
                            class="rounded-lg"
                            placeholder="Placeholder"
                            background-color="grey lighten-2"
                        ></v-text-field>

                    </div>
                </v-col>
                <v-col md="8" cols="12" class="d-flex justify-content-between">
                    <div>
                        <p class="grey--text py-1 caption">Возраст</p>
                        <div class="d-sm-block d-md-flex">
                            <v-text-field
                                solo
                                flat
                                dense
                                hide-details
                                type="number"
                                :label="userData.age"
                                class="rounded-lg"
                                placeholder="Placeholder"
                                background-color="grey lighten-2"
                            ></v-text-field>
                        </div>
                    </div>
                    <div>
                        <p class="grey--text py-1 caption">Пол</p>
                        <div class="d-sm-block d-md-flex">
                            <v-select
                                solo
                                flat
                                dense
                                hide-details
                                :label="userData.gender"
                                class="rounded-lg"
                                background-color="grey lighten-2"
                            ></v-select>
                        </div>
                    </div>
                </v-col>
                <v-col md="8" cols="12">
                    <div>
                        <p class="grey--text py-1 caption">Хобби</p>
                    </div>
                    <div class="d-sm-block d-md-flex">
                        <v-autocomplete
                            flat
                            solo
                            dense
                            multiple
                            hide-details
                            class="rounded-lg"
                            v-model="selected"
                            :items="['Плавание', 'Футбол', 'Рыбалка', 'Охота', 'Чтение', 'Паркур', 'Хакерство']"
                            background-color="grey lighten-2"
                        ></v-autocomplete>
                    </div>
                </v-col>
                <v-col md="8" cols="12">
                    <v-btn depressed color="primary" class="text-capitalize rounded-lg mr-2">Сохранить</v-btn>
                    <v-btn depressed color="primary" class="text-capitalize rounded-lg ml-2">Отменить</v-btn>
                </v-col>
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
            showPassword: false,
            items: ['Плавание', 'Футбол', 'Рыбалка', 'Охота', 'Чтение', 'Паркур', 'Хакерство'],
            isSelecting: false,
            selectedFile: null,
            selected: ['Плавание', 'Футбол']
        }
    },
    computed: {
        selectedPhoto() {
            return this.selectedFile ? URL.createObjectURL(this.selectedFile) : this.userData.avatar;
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
        }
    }
}
</script>

<style scoped>
@media (max-width: 767px) {
    .main-block {
        max-width: 100%;
    }

    .avatar-section {
        flex-direction: column;
    }

    .avatar-title {
        text-align: center;
        color: #0d47a1;
    }
}

@media (min-width: 768px) {
    .main-block {
        max-width: 100%;
    }
}

</style>

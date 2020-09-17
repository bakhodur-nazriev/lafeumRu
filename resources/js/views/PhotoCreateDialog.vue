<template>
    <v-dialog :value="value" width="700" @input="$emit('input', false)">
        <v-card>
            <v-form @submit="addPhoto" ref="createForm">
                <v-card-title class="primary white--text pa-4">
                    Добавить фото
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12 py-0">
                            <v-file-input
                                outlined
                                prepend-icon=""
                                label="Выберите фото"
                                :rules="[rules.required]"
                                v-model="newPhoto.image"
                                prepend-inner-icon="mdi-camera"
                            />
                        </v-col>
                        <v-col cols="12 py-0">
                            <date-picker
                                with-time
                                label="Дата публикации"
                                v-model="newPhoto.publish_at"
                            />
                        </v-col>
                        <v-col cols="12 py-0">
                            <v-textarea
                                outlined
                                :rules="[rules.required]"
                                label="Добавить описание"
                                v-model="newPhoto.description"
                            />
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions class="p-3">
                    <v-spacer/>
                    <v-btn dark color="green" type="submit">Сохранить</v-btn>
                    <v-btn dark color="error" type="button" @click="$emit('input', false)">
                        Отмена
                    </v-btn>
                </v-card-actions>
            </v-form>

        </v-card>
    </v-dialog>
</template>

<script>
    import rules from "../validation-rules";
    import DatePicker from "../components/DatePicker";

    export default {
        props: {value: Boolean},
        components: {"date-picker": DatePicker},
        data() {
            return {
                rules,
                newPhoto: null,
            }
        },
        beforeMount() {
            this.newPhoto = this.getDefaultPhoto();
        },
        methods: {
            getDefaultPhoto() {
                return {
                    image: null,
                    description: "",
                    publish_at: ""
                };
            },
            resetNewPhoto() {
                this.newPhoto = this.getDefaultPhoto();
            },
            addPhoto(e) {
                e.preventDefault();

                const validForm = this.$refs.createForm.validate();


                if (!validForm) return;

                const formData = new FormData();

                formData.append("image", this.newPhoto.image);
                formData.append("publish_at", this.newPhoto.publish_at);
                formData.append("description", this.newPhoto.description);

                axios
                    .post("/api/photos", formData, {
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(res => {
                        this.resetNewPhoto();
                        this.$emit('created', res.data);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
        }
    }
</script>


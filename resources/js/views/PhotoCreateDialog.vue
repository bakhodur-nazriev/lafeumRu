<template>
    <v-dialog :value="value" @input="$emit('input', false)" width="700">
        <v-card>
            <v-form ref="createForm" @submit="addPhoto">
                <v-card-title class="primary white--text pa-4">
                    Добавить фото
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-file-input
                                prepend-inner-icon="mdi-camera"
                                label="Выберите фото"
                                prepend-icon=""
                                hide-details
                                outlined
                                v-model="newPhoto.photoImage"
                            ></v-file-input>
                        </v-col>
                        <v-col cols="12">
                            <date-picker
                                v-model="newPhoto.created_at"
                                @created=""
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                outlined
                                v-model="newPhoto.description"
                                label="Добавить описание"
                                hide-details
                            />
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" type="submit">Сохранить</v-btn>
                    <v-btn
                        dark
                        color="error"
                        type="button"
                        @click="$emit('input', false)"
                    >
                        Отмена
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
    import DatePicker from "../components/DatePicker";

    export default {
        props: {
            modalDate: String,
            value: Boolean
        },
        components: {
            "date-picker": DatePicker
        },
        date() {
            return {
                newPhoto: null,
                modalDate: false
            }
        },
        beforeMount() {
            this.newPhoto = this.getDefaultPhoto();
        },

        methods: {
            getDefaultPhoto() {
                return {
                    description: "",
                    created_at: ""
                };
            },

            resetNewPhoto() {
                this.newPhoto = this.getDefaultPhoto();
                this.$refs.createForm.reset();
            },

            addPhoto(e) {
                e.preventDefault();

                this.$refs.createForm.validate();

                /*const validForm = this.$refs.createForm.validate();

                if (!validForm) return;*/

                axios
                    .post("/api/photos/", this.newPhoto, formData, {
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(res => {
                        this.resetNewPhoto();
                        this.$emit('creaeted', res.data);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
        }
    }
</script>


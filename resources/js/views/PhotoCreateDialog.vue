<template>
    <v-dialog :value="value" width="700" @input="$emit('input', false)">
        <v-card>
            <v-form @submit="addPhoto" ref="createForm" v-if="!isSendingData">
                <v-card-title class="primary white--text pa-4">
                    Добавить фото
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-file-input
                                outlined
                                hide-details
                                prepend-icon=""
                                label="Выберите фото"
                                v-model="newPhoto.image"
                                :rules="[rules.required]"
                                prepend-inner-icon="mdi-camera"
                            />
                        </v-col>
                        <v-col cols="12">
                            <date-picker
                                label="Добавить дату"
                                :rules="[rules.required]"
                                v-model="newPhoto.created_at"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                outlined
                                hide-details
                                :rules="[rules.required]"
                                label="Добавить описание"
                                v-model="newPhoto.description"
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
            <div class="py-5 text-center" v-else>
                <v-progress-circular indeterminate color="primary"/>
            </div>
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
                isSendingData: false
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
                    created_at: ""
                };
            },
            resetNewPhoto() {
                this.newPhoto = this.getDefaultPhoto();
                // this.$refs.createForm.reset();
            },
            addPhoto(e) {
                e.preventDefault();

                this.$refs.createForm.validate();

                this.isSendingData = true;

                const validForm = this.$refs.createForm.validate();

                if (!validForm) return;
                const formData = new FormData();
                formData.append("image", this.newPhoto.image);
                formData.append("description", this.newPhoto.description);
                formData.append("created_at", this.newPhoto.created_at);

                axios
                    .post("/api/photos/", formData, {
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(res => {
                        this.isSendingData = false;
                        this.resetNewPhoto();
                        this.$emit('created', res.data);
                    })
                    .catch(err => {
                        this.isSendingData = false;
                        console.log(err);
                    });
            },
        }
    }
</script>


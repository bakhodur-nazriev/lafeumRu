<template>
    <!-- Add Item Dialog -->
    <v-dialog :value="value" @input="$emit('input', false)" width="700">
        <v-card>
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
                            v-model="photoImage"
                        ></v-file-input>
                    </v-col>
                    <v-col cols="12">
                        <v-dialog
                            ref="dialog"
                            v-model="modalDate"
                            persistent
                            width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    v-model="photoCreatedAtDate"
                                    label="Выберите дату"
                                    prepend-inner-icon="mdi-calendar"
                                    readonly
                                    outlined
                                    v-on="on"
                                    hide-details
                                ></v-text-field>
                            </template>
                            <v-date-picker v-model="photoCreatedAtDate" scrollable>
                                <v-spacer></v-spacer>
                                <v-btn text color="primary" @click="modalDate= false">Отмена</v-btn>
                                <v-btn text color="primary"
                                       @click="$refs.dialog.save(photoCreatedAtDate.created_at)">OK
                                </v-btn>
                            </v-date-picker>
                        </v-dialog>
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            outlined
                            v-model="photoDescription"
                            label="Добавить описание"
                            hide-details
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer/>
                <v-btn dark color="green" @click="addPhoto()">Сохранить</v-btn>
                <v-btn dark color="error" @click="() => (dialogAdd = false)">Отмена</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        props: {
            value: Boolean
        },
        date() {
            return {
                modalDate: false
            }
        },
        beforeMount() {
            this.newPhoto = this.getDefaultPhoto();
        },
        methods: {
            addPhoto() {
                const formData = new FormData();
                formData.append("path", this.photoImage);
                formData.append("description", this.photoDescription);
                formData.append("created_at", this.photoCreatedAtDate);
                axios
                    .post("/api/photos/", formData, {
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(res => {
                        this.dialogAdd = false;
                        this.$refs.indexPage.loadItems();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
        }
    }
</script>


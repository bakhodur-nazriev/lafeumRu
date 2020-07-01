<template>
    <!-- Update Item Dialog -->
    <v-dialog v-if="photoToUpdate" v-model="photoToUpdate" width="700">
        <v-card>
            <v-card-title class="primary white--text pa-4">
                Изменить описание фото
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-dialog
                            ref="dialog"
                            v-model="modalDate"
                            :return-value.sync="photoToUpdate.updated_at"
                            persistent
                            width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    v-model="photoToUpdate.updated_at"
                                    label="Выберите дату"
                                    prepend-inner-icon="mdi-calendar"
                                    readonly
                                    outlined
                                    v-on="on"
                                    hide-details
                                ></v-text-field>
                            </template>
                            <v-date-picker v-model="photoToUpdate.updated_at" scrollable>
                                <v-spacer></v-spacer>
                                <v-btn text color="primary" @click="modalDate= false">Отмена</v-btn>
                                <v-btn text color="primary" @click="$refs.dialog.save(photoToUpdate.updated_at)">
                                    OK
                                </v-btn>
                            </v-date-picker>
                        </v-dialog>
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            v-model="photoToUpdate.description"
                            label="Описание"
                            outlined
                            hide-details
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer/>
                <v-btn dark color="green" @click="updatePhoto()">Сохранить</v-btn>
                <v-btn dark color="error" @click="photoToUpdate = false">Отмена</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        props: {
            value: Object
        },
        data() {
            return {modalDate: false}
        },
        methods: {
            updatePhoto() {
                axios
                    .put("/api/photos/" + this.photoToUpdate.id, {
                        description: this.photoToUpdate.description,
                        updated_at: this.photoToUpdate.updated_at
                    })
                    .then(res => {
                        this.photoToUpdate = false;
                        this.$refs.indexPage.loadItems();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        computed: {
            photoToUpdate: {
                get() {
                    return this.value;
                },
                set(v) {
                    if (!v) {
                        this.$emit('input', null)
                    }
                }
            }
        }
    }
</script>

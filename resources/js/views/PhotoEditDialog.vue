<template>
    <v-dialog v-if="photoToUpdate" v-model="photoToUpdate" width="700">
        <v-card>
            <v-card-title class="primary white--text pa-4">
                Изменить описание фото
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <date-picker
                            label="Изменить дату"
                            :rules="[rules.required]"
                            v-model="photoToUpdate.updated_at"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            outlined
                            hide-details
                            label="Описание"
                            :rules="[rules.required]"
                            v-model="photoToUpdate.description"
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
    import DatePicker from "../components/DatePicker";
    import rules from "../validation-rules";

    export default {
        components: {
            "date-picker": DatePicker
        },
        props: {
            value: Object
        },
        data() {
            return {
                rules,
                modalDate: ""
            }
        },
        methods: {
            updateDate() {
                this.photoToUpdate = null;
                this.$refs.indexPage.loadItems();
            },
            updatePhoto() {
                axios
                    .put("/api/photos/" + this.photoToUpdate.id, {
                        updated_at: this.photoToUpdate.updated_at,
                        description: this.photoToUpdate.description
                    })
                    .then(res => {
                        this.$emit('updated', res.data);
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
                        this.$emit('input', null);
                    }
                }
            }
        }
    }
</script>

<template>
    <v-dialog v-if="photoToUpdate" v-model="photoToUpdate" width="750">
        <v-card v-if="!isSendingData">
            <v-card-title class="primary white--text pa-4">
                Изменить описание фото
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12 py-0">
                        <date-picker
                            with-time
                            label="Дата публикацииы"
                            v-model="photoToUpdate.publish_at"
                        />
                    </v-col>
                    <v-col cols="12 py-0">
                        <v-textarea
                            outlined
                            label="Описание"
                            :rules="[rules.required]"
                            v-model="photoToUpdate.description"
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions class="p-3">
                <v-spacer/>
                <v-btn dark color="primary" @click="updatePhoto()">Сохранить</v-btn>
                <v-btn dark color="primary" @click="photoToUpdate = false">Отмена</v-btn>
            </v-card-actions>
        </v-card>
        <v-card v-else>
            <div class="py-5 text-center">
                <v-progress-circular indeterminate color="primary"/>
            </div>
        </v-card>
    </v-dialog>
</template>

<script>
    import DatePicker from "../../components/DatePicker";
    import rules from "../../validation-rules";

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
                modalDate: "",
                isSendingData: false
            }
        },
        methods: {
            updatePhoto() {
                this.isSendingData = true;
                axios
                    .put("/api/photos/" + this.photoToUpdate.id, this.photoToUpdate)
                    .then(res => {
                        this.isSendingData = false;
                        this.$emit('updated', res.data);
                    })
                    .catch(err => {
                        this.isSendingData = false;
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

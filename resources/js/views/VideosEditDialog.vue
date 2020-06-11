<template>
    <v-dialog v-if="videoToUpdate" v-model="videoToUpdate" width="700px">
        <v-card>
            <v-card-title class="primary white--text">
                Изменить Видео
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field
                            hide-details
                            outlined
                            v-model="videoToUpdate.title"
                            label="Изменить названия видео"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-select
                            hide-details
                            outlined
                            :items="channels"
                            item-value="id"
                            item-text="name"
                            v-model="videoToUpdate.channel_id"
                            label="Изменить канал видео"
                        >
                        </v-select>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            hide-details
                            outlined
                            v-model="videoToUpdate.link"
                            label="Изменить ссылку видео"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-dialog
                            ref="dialog"
                            v-model="modalDate"
                            :return-value.sync="videoToUpdate.updated_at"
                            persistent
                            width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    v-model="videoToUpdate.updated_at"
                                    label="Выберите дату"
                                    prepend-inner-icon="mdi-calendar"
                                    readonly
                                    outlined
                                    v-on="on"
                                    hide-details
                                ></v-text-field>
                            </template>
                            <v-date-picker v-model="videoToUpdate.updated_at" scrollable>
                                <v-spacer></v-spacer>
                                <v-btn text color="primary" @click="modalDate= false">Отмена</v-btn>
                                <v-btn text color="primary" @click="$refs.dialog.save(videoToUpdate.updated_at)">OK
                                </v-btn>
                            </v-date-picker>
                        </v-dialog>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            hide-details
                            outlined
                            v-model="videoToUpdate.duration"
                            label="Изменить продолжителность видео в минутах"
                        >
                        </v-text-field>
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer/>
                <v-btn dark color="green" @click="updateVideo()">Сохранить</v-btn>
                <v-btn dark color="error" @click="$emit('input', null)">Отмена</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        props: {
            value: Object,
            channels: Array,
            categories: Array,
            updated_at: String
        },
        data() {
            return {modalDate: false}
        },
        methods: {
            updateVideo() {
                axios
                    .put("/api/videos/" + this.videoToUpdate.id, this.videoToUpdate, {
                        updated_at: this.videoToUpdate.updated_at
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
            videoToUpdate: {
                get() {
                    return this.value;
                },
                set(v) {
                    if (!v) {
                        this.$emit("input", null);
                    }
                }
            }
        }
    };
</script>

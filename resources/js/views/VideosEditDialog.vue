<template>
    <v-dialog v-if="videoToUpdate" v-model="videoToUpdate" width="750px">
        <v-card>
            <v-card-title class="primary white--text pa-4">
                Изменить Видео
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12 py-0">
                        <v-textarea
                            outlined
                            :rules="[rules.required]"
                            v-model="videoToUpdate.title"
                            label="Изменить названия видео"
                        />
                    </v-col>
                    <v-col cols="12 py-0">
                        <v-autocomplete
                            outlined
                            item-value="id"
                            item-text="name"
                            :items="channels"
                            :rules="[rules.required]"
                            label="Изменить канал видео"
                            v-model="videoToUpdate.channel_id"
                        />
                    </v-col>
                    <v-col cols="12 py-0">
                        <v-text-field
                            outlined
                            :rules="[rules.required]"
                            v-model="videoToUpdate.link"
                            label="Изменить ссылку видео"
                        />
                    </v-col>
                    <v-col cols="12 py-0">
                        <v-text-field
                            outlined
                            :rules="[rules.required]"
                            v-model="videoToUpdate.duration"
                            label="Изменить продолжителность видео в минутах"
                        />
                    </v-col>
                    <v-col cols="12 py-0">
                        <v-autocomplete
                            outlined
                            multiple
                            item-value="id"
                            item-text="name"
                            label="Категории"
                            :items="categories"
                            :rules="[rules.required]"
                            v-model="videoToUpdate.categories"
                        />
                    </v-col>
                    <v-col cols="12 py-0">
                        <date-picker
                            with-time
                            label="Дата публикации"
                            :rules="[rules.required]"
                            v-model="videoToUpdate.publish_at"
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions class="p-3">
                <v-spacer/>
                <v-btn dark color="primary" @click="updateVideo()">Сохранить</v-btn>
                <v-btn dark color="primary" @click="$emit('input', null)">Отмена</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    import DatePicker from "../components/DatePicker";
    import rules from "../validation-rules";

    export default {
        components: {DatePicker},
        props: {
            value: Object,
            channels: Array,
            categories: Array,
        },
        data() {
            return {
                rules
            }
        },
        methods: {
            updateVideo() {
                let updatedVideo = this.videoToUpdate;

                updatedVideo.categories = this.extractIds(updatedVideo.categories);
                axios
                    .put("/api/videos/" + this.videoToUpdate.id, updatedVideo)
                    .then(res => {
                        this.$emit('updated', res.data);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            extractIds(array) {
                return array.map(a => {
                    return typeof a === 'number' ? a : (a.hasOwnProperty('id') ? a.id : null);
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

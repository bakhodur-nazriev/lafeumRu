<template>
    <v-dialog v-if="videoToUpdate" v-model="videoToUpdate" width="700px">
        <v-card>
            <v-card-title class="primary white--text pa-4">
                Изменить Видео
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-textarea
                            outlined
                            hide-details
                            :rules="[rules.required]"
                            v-model="videoToUpdate.title"
                            label="Изменить названия видео"
                        >
                        </v-textarea>
                    </v-col>
                    <v-col cols="12">
                        <v-select
                            outlined
                            hide-details
                            item-value="id"
                            item-text="name"
                            :items="channels"
                            :rules="[rules.required]"
                            label="Изменить канал видео"
                            v-model="videoToUpdate.channel_id"
                        >
                        </v-select>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            outlined
                            hide-details
                            :rules="[rules.required]"
                            v-model="videoToUpdate.link"
                            label="Изменить ссылку видео"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            outlined
                            hide-details
                            :rules="[rules.required]"
                            v-model="videoToUpdate.duration + ' мин'"
                            label="Изменить продолжителность видео в минутах"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-select
                            outlined
                            multiple
                            hide-details
                            item-value="id"
                            item-text="name"
                            label="Категории"
                            :items="categories"
                            :rules="[rules.required]"
                            v-model="videoToUpdate.categories"
                        />
                    </v-col>
                    <v-col cols="12">
                        <date-picker
                            label="Изменить дату"
                            :rules="[rules.required]"
                            v-model="videoToUpdate.updated_at"
                        />
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
                    .put("/api/videos/" + this.videoToUpdate.id, updatedVideo, {
                        link: this.videoToUpdate.link,
                        categories: this.videoToUpdate.categories,
                        updated_at: this.videoToUpdate.updated_at
                    })
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

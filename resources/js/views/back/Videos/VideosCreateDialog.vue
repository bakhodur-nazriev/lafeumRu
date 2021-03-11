<template>
    <v-dialog :value="value" width="750px" @input="$emit('input', false)">
        <v-card>
            <v-form @submit="addVideo" ref="createForm">
                <v-card-title class="primary white--text">
                    Создать Видео
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12 py-0">
                            <v-text-field
                                outlined
                                label="Введите название"
                                v-model="newVideo.title"
                                :rules="[rules.required]"
                            />
                        </v-col>
                        <v-col cols="12 py-0">
                            <v-autocomplete
                                outlined
                                item-value="id"
                                item-text="name"
                                :items="channels"
                                label="Выберите канал"
                                :rules="[rules.required]"
                                v-model="newVideo.channel_id"
                            />
                        </v-col>
                        <v-col cols="12 py-0">
                            <v-autocomplete
                                outlined
                                multiple
                                item-value="id"
                                item-text="name"
                                :items="categories"
                                :rules="[rules.required]"
                                label="Выберите категории"
                                v-model="newVideo.categories"
                            />
                        </v-col>
                        <v-col cols="12 py-0">
                            <v-text-field
                                outlined
                                label="Добавьте ссылку"
                                v-model="newVideo.link"
                                :rules="[rules.required]"
                            />
                        </v-col>
                        <v-col cols="12 py-0">
                            <v-text-field
                                outlined
                                type="number"
                                :rules="[rules.required]"
                                v-model="newVideo.duration"
                                label="Добавьте продолжительность (в мин.)"
                            />
                        </v-col>
                        <v-col cols="12 py-0">
                            <date-picker
                                with-time
                                label="Дата публикации"
                                v-model="newVideo.publish_at"
                            />
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions class="p-3">
                    <v-spacer/>
                    <v-btn dark color="primary" type="submit">Сохранить</v-btn>
                    <v-btn dark color="primary" type="button" @click="$emit('input', false)">
                        Отмена
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
    import rules from "../../../validation-rules";
    import DatePicker from "../../../components/DatePicker";

    export default {
        components: {
            "date-picker": DatePicker
        },
        props: {
            value: Boolean,
            channels: Array,
            categories: Array,
        },
        data() {
            return {
                rules,
                newVideo: null,
                modalDate: false
            };
        },
        beforeMount() {
            this.newVideo = this.getDefaultVideo();
        },
        methods: {
            getDefaultVideo() {
                return {
                    link: "",
                    title: "",
                    duration: "",
                    categories: [],
                    channel_id: null,
                    publish_at: ""
                };
            },
            resetNewVideoForm() {
                this.newVideo = this.getDefaultVideo();
                this.$refs.createForm.reset();
            },
            addVideo(e) {
                e.preventDefault();

                const validForm = this.$refs.createForm.validate();

                if (!validForm) return;

                axios
                    .post("/api/videos", this.newVideo)
                    .then(res => {
                        this.resetNewVideoForm();
                        this.$emit("created", res.data);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        }
    };
</script>

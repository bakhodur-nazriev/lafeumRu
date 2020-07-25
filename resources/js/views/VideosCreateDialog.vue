<template>
    <v-dialog :value="value" width="700px" @input="$emit('input', false)">
        <v-card>
            <v-form ref="createForm" @submit="addVideo">
                <v-card-title class="primary white--text">
                    Создать Видео
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-text-field
                                outlined
                                hide-details
                                label="Введите название"
                                v-model="newVideo.title"
                                :rules="[rules.required]"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-autocomplete
                                outlined
                                hide-details
                                item-value="id"
                                item-text="name"
                                :items="channels"
                                label="Выберите канал"
                                :rules="[rules.required]"
                                v-model="newVideo.channel_id"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-autocomplete
                                outlined
                                multiple
                                hide-details
                                item-value="id"
                                item-text="name"
                                :items="categories"
                                :rules="[rules.required]"
                                label="Выберите категории"
                                v-model="newVideo.categories"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                outlined
                                hide-details
                                label="Добавьте ссылку"
                                v-model="newVideo.link"
                                :rules="[rules.required]"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                outlined
                                hide-details
                                type="number"
                                :rules="[rules.required]"
                                v-model="newVideo.duration"
                                label="Добавьте продолжительность (в мин.)"
                            />
                        </v-col>
                        <v-col cols="12">
                            <date-picker
                                v-model="newVideo.created_at"
                                label="Добавить дату"
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
    import rules from "../validation-rules";
    import DatePicker from "../components/DatePicker";

    export default {
        components: {DatePicker},
        props: {
            value: Boolean,
            channels: Array,
            categories: Array,
        },
        data() {
            return {
                rules,
                newVideo: null,
                modalDate: false,
            };
        },
        beforeMount() {
            this.newVideo = this.getDefaultVideo();
        },
        methods: {
            getDefaultVideo() {
                return {
                    title: "",
                    link: "",
                    duration: "",
                    categories: [],
                    channel_id: null
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

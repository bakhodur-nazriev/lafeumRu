<template>
    <v-dialog :value="value" width="700px" @input="$emit('input', false)">
        <v-card>
            <v-form ref="createForm" @submit="addVideo">
                <v-card-title class="primary white--text mb-5">
                    Создать Видео
                </v-card-title>
                <v-card-text>
                    <v-text-field
                        label="Введите название"
                        v-model="newVideo.title"
                        outlined
                        :rules="[rules.required]"
                    />
                    <v-select
                        label="Выберите канал"
                        v-model="newVideo.channel_id"
                        item-text="name"
                        item-value="id"
                        outlined
                        :items="channels"
                        :rules="[rules.required]"
                    />
                    <v-select
                        v-model="newVideo.categories"
                        :items="categories"
                        outlined
                        multiple
                        item-value="id"
                        item-text="name"
                        label="Выберите категории"
                        :rules="[rules.required]"
                    />
                    <v-text-field
                        label="Добавьте ссылку"
                        v-model="newVideo.link"
                        outlined
                        :rules="[rules.required]"
                    />
                    <v-text-field
                        label="Добавьте продолжительность (в мин.)"
                        type="number"
                        v-model="newVideo.duration"
                        outlined
                        :rules="[rules.required]"
                    />
                </v-card-text>
                <v-card-actions>
                    <v-spacer />
                    <v-btn dark color="green" type="submit">Сохранить</v-btn>
                    <v-btn
                        dark
                        color="error"
                        type="button"
                        @click="$emit('input', false)"
                        >Отмена</v-btn
                    >
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
import rules from "../validation-rules";

export default {
    props: {
        value: Boolean,
        channels: Array,
        categories: Array
    },
    data() {
        return {
            rules,
            newVideo: null
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
                channel_id: null,
                categories: []
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

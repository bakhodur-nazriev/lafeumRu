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
                            label="Изменить названия видео здесь"
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
                            label="Изменить канал видео здесь"
                        >
                        </v-select>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            hide-details
                            outlined
                            v-model="videoToUpdate.link"
                            label="Изменить ссылку видео здесь"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            hide-details
                            outlined
                            v-model="videoToUpdate.duration"
                            label="Изменить продолжителность видео в минутах здесь"
                        >
                        </v-text-field>
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer />
                <v-btn dark color="green" @click="updateVideo()"
                    >Сохранить</v-btn
                >
                <v-btn dark color="error" @click="$emit('input', null)"
                    >Отмена</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        value: Object,
        channels: Array,
        categories: Array
    },
    methods: {
        updateVideo() {
            axios
                .put("/api/videos/" + this.videoToUpdate.id, this.videoToUpdate)
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

<template>
    <v-dialog v-if="authorToUpdate" v-model="authorToUpdate" width="700px">
        <v-card>
            <v-card-title class="primary white--text">
                Изменить Автора
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field
                            hide-details
                            outlined
                            label="Изменить имя автора"
                            v-model="authorToUpdate.name"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-select
                            hide-details
                            outlined
                            label="Группа авторов"
                            :items="groups"
                            item-text="name"
                            item-value="id"
                            v-model="authorToUpdate.author_group_id"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-file-input
                            hide-details
                            outlined
                            name="photo"
                            label="Изменить фото"
                            prepend-icon=""
                            prepend-inner-icon="mdi-camera"
                            v-model="authorToUpdate.photo"
                        >
                        </v-file-input>
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            outlined
                            v-model="authorToUpdate.biography"
                            label="Добаить биографию здесь"
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer />
                <v-btn dark color="green" @click="updateAuthor()"
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
        groups: Array
    },
    methods: {
        updateAuthor() {
            const formData = new FormData();

            const {
                name,
                biography,
                photo,
                author_group_id,
                slug
            } = this.authorToUpdate;

            formData.append("name", name);
            formData.append("biography", biography);
            formData.append("photo", photo);
            formData.append("author_group_id", author_group_id);
            formData.append("_method", "put");

            const url = "/api/authors/" + slug;

            axios
                .post(url, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(res => {
                    this.$emit("updated", res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        authorToUpdate: {
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

<template>
    <v-dialog v-if="authorToUpdate" v-model="authorToUpdate" width="700px">
        <v-card>
            <v-card-title class="primary white--text">
                Изменить Автора
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12" class="py-0">
                        <v-text-field
                            dense
                            outlined
                            label="Изменить имя автора"
                            v-model="authorToUpdate.name"
                        />
                    </v-col>
                    <v-col cols="12" class="py-0">
                        <v-select
                            dense
                            outlined
                            item-value="id"
                            :items="groups"
                            item-text="name"
                            label="Группа авторов"
                            v-model="authorToUpdate.author_group_id"
                        />
                    </v-col>
                    <v-col cols="12" class="py-0">
                        <v-file-input
                            dense
                            outlined
                            name="photo"
                            prepend-icon=""
                            label="Изменить фото"
                            prepend-inner-icon="mdi-camera"
                            v-model="authorToUpdate.photo"
                        />
                    </v-col>
                    <v-col cols="12" class="py-0">
                        <wysiwyg-editor
                            label="Изменить биографию здесь"
                            v-model="authorToUpdate.biography"
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions class="pa-3">
                <v-spacer/>
                <v-btn color="primary" @click="updateAuthor()">Сохранить</v-btn>
                <v-btn color="primary" @click="$emit('input', null)">Отмена</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import WysiwygEditor from '../../../components/WysiwygEditor';

export default {
    props: {
        value: Object,
        groups: Array
    },
    components: {WysiwygEditor},
    methods: {
        updateAuthor() {
            const formData = new FormData();

            const {
                name,
                slug,
                photo,
                biography,
                author_group_id
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

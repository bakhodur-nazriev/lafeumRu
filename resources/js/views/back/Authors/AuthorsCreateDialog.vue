<template>
    <v-dialog :value="value" @input="$emit('input', false)" width="700px">
        <v-card>
            <v-card-title class="primary white--text">
                Создать Автора
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12" class="py-0">
                        <v-text-field
                            dense
                            outlined
                            label="Имя автора"
                            v-model="newAuthor.name"
                        />
                    </v-col>
                    <v-col cols="12" class="py-0">
                        <v-select
                            dense
                            outlined
                            :items="groups"
                            item-value="id"
                            item-text="name"
                            label="Группа авторов"
                            v-model="newAuthor.author_group_id"
                        />
                    </v-col>
                    <v-col cols="12" class="py-0">
                        <v-file-input
                            dense
                            outlined
                            prepend-icon=""
                            label="Выберите фото"
                            v-model="newAuthor.photo"
                            prepend-inner-icon="mdi-camera"
                        />
                    </v-col>
                    <v-col cols="12" class="py-0">
                        <wysiwyg-editor
                            label="Биография автора"
                            v-model="newAuthor.biography"
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions class="pa-3">
                <v-spacer/>
                <v-btn color="primary" @click="addAuthor()">Сохранить</v-btn>
                <v-btn color="primary" @click="$emit('input', null)">Отмена</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import WysiwygEditor from '../../../components/WysiwygEditor';

export default {
    props: {
        value: Boolean,
        groups: Array
    },
    components: {WysiwygEditor},
    data() {
        return {
            newAuthor: null
        };
    },
    beforeMount() {
        this.newAuthor = this.getDefaultAuthor();
    },
    methods: {
        getDefaultAuthor() {
            return {
                name: "",
                photo: null,
                biography: "",
                author_group_id: null
            };
        },
        addAuthor() {
            const formData = new FormData();

            const {name, biography, photo, author_group_id} = this.newAuthor;

            formData.append("name", name);
            formData.append("biography", biography);
            formData.append("photo", photo);
            formData.append("author_group_id", author_group_id);
            formData.append("_method", "post");

            axios
                .post("/api/authors", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(res => {
                    this.$emit("created", res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

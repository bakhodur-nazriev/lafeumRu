<template>
    <v-dialog v-model="value" width="700px">
        <v-card>
            <v-card-title class="primary white--text">
                Создать Автора
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field
                            hide-details
                            outlined
                            label="Имя автора"
                            v-model="newAuthor.name"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-select
                            hide-details
                            outlined
                            label="Группа авторов"
                            :items="groups"
                            item-text="name"
                            item-value="id"
                            v-model="newAuthor.author_group_id"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-file-input
                            hide-details
                            outlined
                            label="Выберите фото"
                            v-model="newAuthor.photo"
                            prepend-icon=""
                            prepend-inner-icon="mdi-camera"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            outlined
                            label="Биография автора"
                            v-model="newAuthor.biography"
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer />
                <v-btn dark color="green" @click="addAuthor()">Сохранить</v-btn>
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
        value: Boolean,
        groups: Array
    },
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

            const { name, biography, photo, author_group_id } = this.newAuthor;

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

<template>
    <v-content class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-col md="6">
                    <v-text-field
                        solo
                        hide-details
                        class="mb-1"
                        label="Поиск"
                        append-icon="mdi-magnify"
                        v-model="search"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-data-table
                        :click="authorToDelete"
                        :headers="headers"
                        :items="filteredAuthors"
                        :items-per-page="itemsPerPage"
                        :page.sync="page"
                        @page-count="pageCount = $event"
                        hide-default-footer
                        class="elevation-2"
                    >
                        <template v-slot:item.action="{ item }">
                            <v-btn
                                fab
                                dark
                                small
                                color="primary"
                                elevation="2"
                                outlined
                                @click="authorToUpdate = item"
                            >
                                <v-icon dark>mdi-pen</v-icon>
                            </v-btn>
                            <v-btn
                                fab
                                dark
                                small
                                color="primary"
                                elevation="2"
                                outlined
                                @click="authorToShow = item"
                            >
                                <v-icon dark>mdi-file-eye-outline</v-icon>
                            </v-btn>
                            <v-btn
                                fab
                                dark
                                small
                                color="error"
                                elevation="2"
                                outlined
                                @click="authorToDelete = item"
                            >
                                <v-icon dark>mdi-delete</v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.biography="{ item }">
                            <div v-html="item.biography"></div>
                        </template>
                        <template v-slot:item.photo="{ item }">
                            <v-avatar size="78" class="ma-1">
                                <v-img
                                    :src="item.photo"
                                    :alt="item.name"
                                    max-width="6rem"
                                >
                                </v-img>
                            </v-avatar>
                        </template>
                    </v-data-table>
                    <v-col cols="4" offset="4">
                        <v-pagination
                            v-model="page"
                            :length="pageCount"
                            class="my-4"
                        >
                        </v-pagination>
                    </v-col>
                </v-col>
            </v-row>
        </v-container>
        <v-tooltip top>
            <template v-slot:activator="{ on }">
                <v-btn
                    bottom
                    color="primary"
                    v-on="on"
                    dark
                    fab
                    fixed
                    right
                    @click="dialogAdd = !dialogAdd"
                >
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>
            <span>Добавить цитату</span>
        </v-tooltip>
        <!-- Add Item Dialog -->
        <v-dialog v-model="dialogAdd" width="700px">
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
                                v-model="authorName"
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-file-input
                                hide-details
                                outlined
                                label="Выберите фото"
                                v-model="authorPhoto"
                                prepend-icon=""
                                prepend-inner-icon="mdi-camera"
                            >
                            </v-file-input>
                        </v-col>
                        <v-col cols="12">
                            <tiptap-vuetify
                                :extensions="extensions"
                                elevation="0"
                                outlined
                                label="Биография автора"
                                v-model="authorBiography"
                            >
                            </tiptap-vuetify>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="addAuthor()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="() => (dialogAdd = false)">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Delete Item Dialog -->
        <v-dialog v-if="authorToDelete" v-model="authorToDelete" width="500">
            <v-card class="pa-2">
                <p class="pt-1 regular headline text-center"
                >Вы действительно хотите удалить <br>автора ?
                </p>
                <v-card-actions class="justify-center">
                    <v-btn color="green darken-1" dark @click="authorToDelete = false">
                        Нет
                    </v-btn>
                    <v-btn color="red darken-1" dark @click="deleteAuthor()">
                        Да
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Update Item Dialog -->
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
                            <tiptap-vuetify
                                outlined
                                v-model="authorToUpdate.biography"
                                :extensions="extensions"
                                placeholder="Добаить биографию здесь"
                            >
                            </tiptap-vuetify>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="updateAuthor()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="authorToUpdate = false">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Show Item Dialog -->
        <v-dialog v-if="authorToShow" v-model="authorToShow" width="700px">
            <v-card>
                <v-card-title class="primary white--text">
                    Создать Автора
                </v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <h1>Hello World</h1>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="error" @click="() => (authorToShow = false)">Закрыть</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-content>
</template>
<script>
    import {
        // component
        TiptapVuetify,
        // extensions
        Heading,
        Bold,
        Italic,
        Strike,
        Underline,
        Code,
        Paragraph,
        BulletList,
        OrderedList,
        ListItem,
        Link,
        Blockquote,
        HardBreak,
        HorizontalRule,
        History,
        Image
    } from 'tiptap-vuetify';

    export default {
        components: {TiptapVuetify},
        data() {
            return {
                extensions: [
                    History,
                    Blockquote,
                    Link,
                    Underline,
                    Strike,
                    Italic,
                    ListItem,
                    BulletList,
                    OrderedList,
                    Image,
                    [
                        Heading,
                        {
                            options: {
                                levels: [1, 2, 3]
                            }
                        }
                    ],
                    Bold,
                    HorizontalRule,
                    Paragraph,
                    HardBreak
                ],
                authorName: "",
                authorBiography: "",
                search: "",
                authorPhoto: [],
                authors: [],
                page: 1,
                pageCount: 2,
                authorToDelete: null,
                authorToUpdate: null,
                authorToShow: null,
                dialogAdd: false,
                dialogShow: false,
                dialogDelete: false,
                itemsPerPage: 12,
                headers: [
                    {
                        text: "Имя",
                        value: "name",
                        sortable: false
                    },
                    {
                        text: "Биография",
                        value: "biography",
                        sortable: false
                    },
                    {
                        text: "Фото",
                        value: "photo",
                        align: "center",
                        sortable: false
                    },
                    {
                        text: "Дейсвтия",
                        value: "action",
                        align: "center",
                        width: "160px",
                        sortable: false
                    }
                ]
            };
        },
        mounted() {
            this.loadAuthors();
        },
        methods: {
            loadAuthors() {
                axios
                    .get("/api/authors")
                    .then(res => {
                        this.authors = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            addAuthor() {
                const formData = new FormData();
                formData.append("name", this.authorName);
                formData.append("biography", this.authorBiography);
                formData.append("photo", this.authorPhoto);
                formData.append("_method", "post");
                axios
                    .post("/api/authors", formData, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        }
                    })
                    .then(res => {
                        this.dialogAdd = false;
                        this.loadAuthors();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            updateAuthor() {
                const formData = new FormData();
                formData.append("name", this.authorToUpdate.name);
                formData.append("biography", this.authorToUpdate.biography);
                formData.append("photo", this.authorToUpdate.photo);
                formData.append("_method", "put");
                axios
                    .post("/api/authors/" + this.authorToUpdate.id, formData, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        }
                    })
                    .then(res => {
                        this.authorToUpdate = false;
                        this.loadAuthors();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            deleteAuthor() {
                axios
                    .delete("/api/authors/" + this.authorToDelete.id)
                    .then(res => {
                        this.authorToDelete = false;
                        this.loadAuthors();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        computed: {
            filteredAuthors() {
                return this.authors.filter(author => {
                    return author.name.toLowerCase().includes(this.search.toLowerCase());
                });
            }
        }
    };
</script>

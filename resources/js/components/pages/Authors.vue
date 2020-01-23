<template>
    <v-content class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-col cols="6">
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
        <v-dialog v-model="dialogAdd" width="600px">
            <v-card>
                <v-card-title class="primary white--text">
                    Создать Автора
                </v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                outlined
                                name="name"
                                label="Имя"
                                v-model="authorName"
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-file-input
                                outlined
                                name="photo"
                                label="Выберите фото"
                                v-model="authorPhoto"
                                prepend-icon=""
                                prepend-inner-icon="mdi-paperclip"
                            >
                            </v-file-input>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                outlined
                                name="biography"
                                label="Биография"
                                v-model="authorBiography"
                            >
                            </v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="addAuthor()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="() => (dialogAdd = false)"
                    >Отмена
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Delete Item Dialog -->
        <v-dialog v-model="dialogDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center"
                >Вы действительно хотите удалить автора ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn color="green darken-1" dark @click="authorToDelete = null">
                        Нет
                    </v-btn>
                    <v-btn color="red darken-1" dark @click="deleteAuthor()">
                        Да
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Update Item Dialog -->
        <v-dialog v-model="dialogUpdate" width="600px">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить Автора
                </v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                outlined
                                label="Изменить имя автора"
                                :value="authorToUpdate.name"
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-file-input
                                outlined
                                name="photo"
                                prepend-icon="mdi-camera"
                                label="Изменить фото"
                                :value="authorToUpdate.photo"
                            >
                            </v-file-input>
                        </v-col>
                        <v-col cols="12">
                            <tiptap-vuetify
                                name="biography"
                                v-model="authorToUpdate.biography"
                                :extensions="extensions"
                            >
                            </tiptap-vuetify>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="updateAuthor()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="dialogUpdate = false">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Show Item Dialog -->
        <v-dialog v-model="dialogShow" width="780px">
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
                    <v-btn dark color="error" @click="() => (dialogShow = false)">Закрыть</v-btn>
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
        data() {
            return {
                extensions: [
                    History,
                    Blockquote,
                    Link,
                    Underline,
                    Strike,
                    Italic,
                    ListItem, // if you need to use a list (BulletList, OrderedList)
                    BulletList,
                    OrderedList,
                    Image,
                    [
                        Heading,
                        {
                            // Options that fall into the tiptap's extension
                            options: {
                                levels: [1, 2, 3]
                            }
                        }
                    ],
                    Bold,
                    Link,
                    Code,
                    HorizontalRule,
                    Paragraph,
                    HardBreak // line break on Shift + Ctrl + Enter
                ],
                authorName: "",
                authorBiography: "",
                authorPhoto: [],
                search: "",
                authors: [],
                page: 1,
                pageCount: 2,
                authorToDelete: {
                    name: null,
                    biography: null,
                    photo: null
                },
                authorToUpdate: {
                    name: null,
                    biography: null,
                    photo: null
                },
                authorToShow: {
                    name: null,
                    biography: null,
                    photo: null
                },
                dialogAdd: false,
                dialogShow: false,
                dialogDelete: false,
                dialogUpdate: false,
                itemsPerPage: 12,
                headers: [
                    {
                        text: "Имя",
                        align: "center",
                        value: "name"
                    },
                    {
                        text: "Фото",
                        value: "image",
                        align: "center",
                        sortable: false
                    },
                    {
                        text: "Биография",
                        value: "biography",
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
                formData.append("photo", this.authorPhoto);

                axios
                    .post("/api/authors", formData, {
                        "Content-Type": "multipart/form-data"
                    })
                    .then(res => {
                        console.log(res);
                        this.loadAuthors();
                        this.dialogAdd = false;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            updateAuthor() {
                axios
                    .put("/api/authors" + this.authorToUpdate.id, {
                        name: "",
                        biography: "",
                        photo: ""
                    })
                    .then(res => {
                        console.log(res);
                        this.loadAuthors();
                        this.dialogUpdate = false;
                    })
                    .catch(res => {
                        console.log(err);
                    });
            },
            deleteAuthor() {
                axios
                    .delete("/api/authors/" + this.authorToDelete.id)
                    .then(res => {
                        this.loadAuthors();
                        this.dialogDelete = false;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        watch: {
            authorToShow(value) {
                if (value) {
                    this.dialogShow = true;
                } else {
                    this.dialogShow = false;
                }
            },
            authorToUpdate(value) {
                if (value) {
                    this.dialogUpdate = true;
                } else {
                    this.dialogUpdate = false;
                }
            },

            authorToDelete(value) {
                if (value) {
                    this.dialogDelete = true;
                } else {
                    this.dialogDelete = false;
                }
            }
        },
        computed: {
            filteredAuthors() {
                return this.authors.filter(authors => {
                    return authors.name.toLowerCase().includes(this.search.toLowerCase());
                });
            }
        }
    };
</script>

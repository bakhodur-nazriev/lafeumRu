<template>
    <v-content class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-col cols="6">
                    <v-text-field
                        class="mb-1"
                        hide-details
                        solo
                        label="Поиск"
                        append-icon="mdi-magnify"
                        v-model="search"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-data-table
                        :headers="headers"
                        :items="filteredPhotos"
                        :items-per-page="itemsPerPage"
                        :page.sync="page"
                        @page-count="pageCount = $event"
                        hide-default-footer
                        class="elevation-1"
                    >
                        <template v-slot:item.image="{ item }">
                            <div class="text-center pa-2">
                                <v-img
                                    :src="item.image"
                                    :alt="item.description"
                                    max-width="6rem"
                                >
                                </v-img>
                            </div>
                        </template>
                        <template v-slot:item.action="{ item }">
                            <v-btn
                                fab
                                dark
                                small
                                color="primary"
                                elevation="2"
                                outlined
                                @click="photoToUpdate = {...item}"
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
                                @click="photoToShow = {...item}"
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
                                @click="photoToDelete = item"
                            >

                                <v-icon dark>
                                    mdi-delete
                                </v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.description="{ item }">
                            <div v-html="item.description" class="short-paragraph"/>
                        </template>
                    </v-data-table>
                </v-col>
                <div class="text-center pt-2">
                    <v-pagination v-model="page" :length="pageCount"></v-pagination>
                </div>
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
            <span>Добавить термин</span>
        </v-tooltip>

        <!-- Add Item Dialog -->
        <v-dialog v-model="dialogAdd" width="780px">
            <v-card>
                <v-card-title class="primary white--text">
                    Создать Термин
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-file-input
                                outlined
                                name="image"
                                label="Выберите фото"
                                prepend-icon=""
                                prepend-inner-icon="mdi-paperclip"
                            >

                            </v-file-input>
                        </v-col>
                        <v-col cols="12">
                            <tiptap-vuetify
                                outlined
                                required
                                v-model="photoDescription"
                                :extensions="extensions"
                                placeholder="Добаить термин здесь"
                            >
                            </tiptap-vuetify>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="addTerm()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="() => (dialogAdd = false)">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Delete Item Dialog -->
        <v-dialog v-model="dialogDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center"
                >Вы действительно хотите удалить это термин ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn color="green darken-1" dark @click="termToDelete = null"
                    >Нет
                    </v-btn>
                    <v-btn color="red darken-1" dark @click="deleteTerm()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Update Item Dialog -->
        <v-dialog v-model="dialogUpdate" width="780px">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить Термин
                </v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <tiptap-vuetify
                                outlined
                                name="body"
                                :extensions="extensions"
                                v-model="photoToUpdate.description"
                                placeholder="Изменить термин здесь"
                            >
                            </tiptap-vuetify>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="updateTerm()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="dialogUpdate = false">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Show Quote Dialog -->
        <v-dialog v-model="dialogShow" width="780px">
            <v-card>
                <v-card-title class="primary white--text">
                    Фото
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">

                        </v-col>
                        <v-col>
                            <v-text-field>
                            </v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="updateTerm()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="dialogUpdate = false">Отмена</v-btn>
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
                valid: false,
                dialogAdd: false,
                dialogDelete: false,
                dialogUpdate: false,
                dialogShow: true,
                photoImage: "",
                photoDescription: "",
                bodyRules: [
                    v => !!v || 'Заполните пустое поле',
                ],
                photos: [],
                search: "",
                page: 1,
                pageCount: 2,
                itemsPerPage: 12,
                photoToShow: {image: null, description: null},
                photoToDelete: {image: null, description: null},
                photoToUpdate: {body: null, description: null},
                headers: [
                    {
                        text: "Фото",
                        value: "image",
                        sortable: false,
                        class: "mine-table-headers",
                        width: "150px",
                        align: "center"
                    },
                    {
                        text: "Описания",
                        value: "description",
                        sortable: false,
                    },
                    {
                        text: "Действия",
                        value: "action",
                        align: "center",
                        sortable: false,
                        width: "160px"
                    }
                ]
            };
        },
        mounted() {
            this.loadPhotos();
        },
        methods: {
            loadPhotos() {
                axios
                    .get("/api/photos/")
                    .then(res => {
                        this.photos = res.data;
                        // console.log(res.data);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            addTerm() {
                axios
                    .post("/api/photos/", {
                        // body: this.termBody
                    })
                    .then(res => {
                        console.log(res);
                        this.loadPhotos();
                        this.dialogAdd = false;
                    })
                    .catch(err => {
                        console.log(err.res.data);
                    });
            },
            updateTerm() {
                axios
                    .put("/api/photos/" + this.photoToUpdate.id, this.photoToUpdate)
                    .then(res => {
                        console.log(res);
                        this.loadPhotos();
                        this.dialogUpdate = false;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            deleteTerm() {
                axios
                    .delete("/api/photos/" + this.photoToDelete.id)
                    .then(res => {
                        this.loadPhotos();
                        this.dialogDelete = false;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
        },
        watch: {
            photoToShow(value) {
                if (value) {
                    this.dialogShow = true;
                } else {
                    this.dialogShow = false;
                }
            },
            photoToUpdate(value) {
                if (value) {
                    this.dialogUpdate = true;
                } else {
                    this.dialogUpdate = false;
                }
            },
            photoToDelete(value) {
                if (value) {
                    this.dialogDelete = true;
                } else {
                    this.dialogDelete = false;
                }
            }
        },
        computed: {
            filteredPhotos() {
                return this.photos.filter(photo => {
                    return photos.description.toLowerCase().includes(this.search.toLowerCase());
                });
            }
        },
    };
</script>

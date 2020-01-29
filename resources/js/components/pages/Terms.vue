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
                        :items="filteredTerms"
                        :items-per-page="itemsPerPage"
                        :page.sync="page"
                        @page-count="pageCount = $event"
                        hide-default-footer
                        class="elevation-1"
                    >
                        <template v-slot:item.action="{ item }">
                            <v-btn
                                fab
                                dark
                                small
                                color="primary"
                                elevation="2"
                                outlined
                                @click="termToUpdate = {...item}"
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
                                @click="termToShow = item"
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
                                @click="termToDelete = item"
                            >
                                <v-icon dark>
                                    mdi-delete
                                </v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.body="{ item }">
                            <div v-html="item.body" class="short-paragraph"/>
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
        <v-dialog v-model="dialogAdd" width="700px">
            <v-card>
                <v-card-title class="primary white--text">
                    Создать Термин
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-text-field
                                hide-details
                                outlined
                                v-model="termName"
                                name="name"
                                label="Добаить названия для термин здесь"
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <tiptap-vuetify
                                outlined
                                name="body"
                                v-model="termBody"
                                :extensions="extensions"
                                placeholder="Добаить описания для термин здесь"
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
        <v-dialog v-if="termToDelete" v-model="termToDelete" width="500">
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
        <v-dialog v-if="termToUpdate" v-model="termToUpdate" width="700px">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить Термин
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-text-field
                                hide-details
                                outlined
                                label="Изменить название термина">
                                :value="termToUpdate.name"
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <tiptap-vuetify
                                outlined
                                name="body"
                                :extensions="extensions"
                                v-model="termToUpdate.body"
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
        <v-dialog v-if="termToShow" v-model="termToShow"></v-dialog>
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
                valid: false,
                dialogAdd: false,
                dialogDelete: false,
                dialogUpdate: false,
                dialogShow: false,
                termName: "",
                termBody: "",
                bodyRules: [
                    v => !!v || 'Заполните пустое поле',
                ],
                terms: [],
                search: "",
                page: 1,
                pageCount: 2,
                itemsPerPage: 12,
                termToDelete: null,
                termToUpdate: null,
                termToShow: null,
                headers: [
                    {
                        text: "Названия",
                        value: "name",
                        sortable: false,
                    },
                    {
                        text: "Термины",
                        value: "body",
                        sortable: false,
                        class: "font-size: 20px"
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
            this.loadTerms();
        },
        methods: {
            loadTerms() {
                axios
                    .get("/api/terms")
                    .then(res => {
                        this.terms = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            addTerm() {
                axios
                    .post("/api/terms/", {
                        name: this.termName,
                        body: this.termBody
                    })
                    .then(res => {
                        this.loadTerms();
                        this.dialogAdd = false;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            updateTerm() {
                axios
                    .put("/api/terms/" + this.termToUpdate.id, this.termToUpdate)
                    .then(res => {
                        console.log(res);
                        this.loadTerms();
                        this.dialogUpdate = false;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            deleteTerm() {
                axios
                    .delete("/api/terms/" + this.termToDelete.id)
                    .then(res => {
                        this.loadTerms();
                        this.dialogDelete = false;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
        },
        // watch: {
        //     termToShow(value) {
        //         if (value) {
        //             this.dialogShow = true;
        //         } else {
        //             this.dialogShow = false;
        //         }
        //     },
        //     termToUpdate(value) {
        //         if (value) {
        //             this.dialogUpdate = true;
        //         } else {
        //             this.dialogUpdate = false;
        //         }
        //     },
        //     termToDelete(value) {
        //         if (value) {
        //             this.dialogDelete = true;
        //         } else {
        //             this.dialogDelete = false;
        //         }
        //     }
        // },
        computed: {
            filteredTerms() {
                return this.terms.filter(term => {
                    return term.body.toLowerCase().includes(this.search.toLowerCase());
                });
            }
        },
    };
</script>

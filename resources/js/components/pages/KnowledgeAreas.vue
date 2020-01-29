<template>
    <v-content class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-col cols="6">
                    <v-text-field
                        solo
                        label="Поиск"
                        hide-details
                        class="mb-1"
                        v-model="search"
                        append-icon="mdi-magnify"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-data-table
                        :headers="headers"
                        :items="filteredKnowledgeAreas"
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
                                @click="knowledgeAreaToUpdate = {...item}"
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
                                @click="knowledgeAreaToShow = { item }"
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
                                @click="knowledgeAreaToDelete = item"
                            >
                                <v-icon dark>mdi-delete</v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.description="{ item }">
                            <div v-html="item.description" class="short-paragraph"></div>
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
            <span>Добавить видео</span>
        </v-tooltip>
        <!-- Add Item Dialog -->
        <v-dialog v-model="dialogAdd" width="700px">
            <v-card>
                <v-card-title class="primary white--text">
                    Создать области знаний
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-text-field
                                hide-details
                                outlined
                                name="name"
                                v-model="knowledgeAreaName"
                                label="Добаить имя области знаний"
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <tiptap-vuetify
                                outlined
                                name="description"
                                :extensions="extensions"
                                v-model="knowledgeAreaDescription"
                                label="Добавить описания области знаний"
                            >
                            </tiptap-vuetify>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="addKnowledgeArea()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="() => (dialogAdd = false)">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Delete Item Dialog -->
        <v-dialog v-if="knowledgeAreaToDelete" v-model="knowledgeAreaToDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center">
                    Вы действительно хотите удалить этот область знаний ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn color="green darken-1" dark @click="knowledgeAreaToDelete = null">
                        Нет
                    </v-btn>
                    <v-btn color="red darken-1" dark @click="deleteKnowledgeArea()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Update Item Dialog -->
        <v-dialog v-if="knowledgeAreaToUpdate" v-model="knowledgeAreaToUpdate" width="700px">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить области зананий
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-text-field
                                hide-details
                                outlined
                                name="name"
                                v-model="knowledgeAreaToUpdate.name"
                                placeholder="Изменить области знаний здесь"
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <tiptap-vuetify
                                outlined
                                name="description"
                                :extensions="extensions"
                                v-model="knowledgeAreaToUpdate.description"
                                placeholder="Изменить области знаний здесь"
                            >
                            </tiptap-vuetify>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="updateKnowledgeArea()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="dialogUpdate = false">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Show Quote Dialog -->
        <v-dialog v-if="knowledgeAreaToShow" v-model="knowledgeAreaToShow" width="700px">
            <v-card>
                <v-card-title>
                    <h1>Hello World</h1>
                </v-card-title>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="error" @click="dialogShow = false">Закрыть</v-btn>
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
                knowledgeAreaName: "",
                knowledgeAreaDescription: "",
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
                knowledgeAreaToDelete: null,
                knowledgeAreaToUpdate: null,
                knowledgeAreaToShow: null,
                search: "",
                dialogAdd: false,
                dialogUpdate: false,
                dialogDelete: false,
                dialogShow: true,
                knowledgeAreas: [],
                page: 1,
                pageCount: 2,
                itemsPerPage: 12,
                headers: [
                    {
                        text: 'Имя',
                        value: 'name',
                        sortable: false,
                    },
                    {
                        text: 'Описания',
                        value: 'description',
                        sortable: false,
                    },
                    {
                        text: 'Действия',
                        value: 'action',
                        align: 'center',
                        sortable: false,
                        width: "160px"
                    }
                ],
            }
        },
        mounted() {
            this.loadKnowledgeAreas();
        },
        methods: {
            loadKnowledgeAreas() {
                axios.get('/api/knowledge-areas').then(res => {
                    this.knowledgeAreas = res.data;
                }).catch(err => {
                    console.log(err);
                });
            },
            addKnowledgeArea() {
                axios
                    .post('/api/knowledge-areas/', {
                        name: this.knowledgeAreaName,
                        description: this.knowledgeAreaDescription
                    })
                    .then(res => {
                        this.loadKnowledgeAreas()
                        this.dialogAdd = false;
                    })
                    .catch((err) => {
                        console.log(err)
                    });
            },
            updateKnowledgeArea() {
                axios
                    .put('/api/knowledge-areas/' + this.knowledgeAreaToUpdate.id, this.knowledgeAreaToUpdate)
                    .then(res => {
                        console.log(res);
                        this.loadKnowledgeAreas();
                        this.dialogUpdate = false;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            deleteKnowledgeArea() {
                axios
                    .delete('/api/knowledge-areas/' + this.knowledgeAreaToDelete.id)
                    .then(res => {
                        this.loadKnowledgeAreas();
                        this.dialogDelete = false;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        computed: {
            filteredKnowledgeAreas() {
                return this.knowledgeAreas.filter(knowledgeArea => {
                    return knowledgeArea.name.toLowerCase().includes(this.search.toLowerCase());
                })
            }
        }
    }
</script>

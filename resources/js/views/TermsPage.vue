<template>
    <v-content class="pa-0">
        <v-container fluid>
            <v-row justify="center">
                <v-col md="6" xl="4">
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
                        :loading="loadingTerms"
                        loading-text="Загрузка..."
                    >
                        <template v-slot:item.action="{ item }">
                            <v-btn
                                fab
                                dark
                                small
                                color="primary"
                                elevation="2"
                                outlined
                                @click="termToUpdate = { ...item }"
                            >
                                <v-icon dark>mdi-pen</v-icon>
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
                                <v-icon dark>mdi-delete</v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.body="{ item }">
                            <div
                                v-html="item.body"
                                class="short-paragraph my-3 three-line-truncate"
                            />
                        </template>
                    </v-data-table>
                </v-col>
                <div class="text-center pt-2">
                    <v-pagination
                        :total-visible="7"
                        v-model="page"
                        :length="pageCount"
                    ></v-pagination>
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
                <v-form ref="createForm" @submit="addTerm">
                    <v-card-title class="primary white--text">
                        Создать Термин
                    </v-card-title>
                    <v-container>
                        <v-text-field
                            outlined
                            v-model="newTerm.name"
                            label="Введите название"
                            :rules="requiredField"
                        />
                        <v-text-field
                            outlined
                            v-model="newTerm.link"
                            label="Ссылка"
                        />
                        <v-select
                            v-model="newTerm.knowledgeAreas"
                            :items="knowledgeAreas"
                            outlined
                            multiple
                            item-value="id"
                            item-text="name"
                            label="Область знаний"
                            :rules="requiredField"
                        />
                        <v-select
                            v-model="newTerm.categories"
                            :items="categories"
                            outlined
                            multiple
                            item-value="id"
                            item-text="name"
                            label="Категории"
                            :rules="requiredField"
                        />
                        <tiptap-vuetify
                            outlined
                            v-model="newTerm.body"
                            :extensions="extensions"
                            placeholder="Введите описание"
                            :card-props="{ flat: true, color: '#21252921' }"
                        />
                    </v-container>
                    <v-card-actions>
                        <v-spacer />
                        <v-btn dark color="green" type="submit"
                            >Сохранить
                        </v-btn>
                        <v-btn
                            dark
                            color="error"
                            @click="() => (dialogAdd = false)"
                            >Отмена
                        </v-btn>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>
        <!-- Delete Item Dialog -->
        <v-dialog v-if="termToDelete" v-model="termToDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center"
                    >Вы действительно хотите удалить это термин ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn
                        color="green darken-1"
                        dark
                        @click="termToDelete = false"
                        >Нет
                    </v-btn>
                    <v-btn color="red darken-1" dark @click="deleteTerm()"
                        >Да
                    </v-btn>
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
                                label="Изменить названия термина"
                                v-model="termToUpdate.name"
                            >
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
                    <v-spacer />
                    <v-btn dark color="green" @click="updateTerm()"
                        >Сохранить
                    </v-btn>
                    <v-btn dark color="error" @click="termToUpdate = false"
                        >Отмена
                    </v-btn>
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
    Paragraph,
    BulletList,
    OrderedList,
    ListItem,
    Link,
    Blockquote,
    HardBreak,
    HorizontalRule,
    History,
    Code
} from "tiptap-vuetify";

export default {
    components: { TiptapVuetify },
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
                [
                    Heading,
                    {
                        options: {
                            levels: [1, 2, 3]
                        }
                    }
                ],
                Code,
                Bold,
                HorizontalRule,
                Paragraph,
                HardBreak
            ],
            valid: false,
            dialogAdd: false,
            categories: [],
            knowledgeAreas: [],
            newTerm: null,
            dialogDelete: false,
            dialogUpdate: false,
            terms: [],
            search: "",
            page: 1,
            pageCount: 2,
            itemsPerPage: 12,
            termToDelete: null,
            termToUpdate: null,
            loadingTerms: false,
            headers: [
                {
                    text: "Название",
                    value: "name",
                    sortable: false
                },
                {
                    text: "Термины",
                    value: "body",
                    sortable: false,
                    class: "ma-3"
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
    beforeMount() {
        this.newTerm = this.getDefaultTerm();
    },
    mounted() {
        this.loadKnowledgeAreas();
        this.loadTermCategories();
        this.loadTerms();
    },
    methods: {
        loadTerms() {
            this.loadingTerms = true;
            axios
                .get("/api/terms")
                .then(res => {
                    this.loadingTerms = false;
                    this.terms = res.data;
                })
                .catch(err => {
                    this.loadingPhotos = false;
                    console.log(err);
                });
        },
        loadKnowledgeAreas() {
            axios
                .get("/api/knowledge-areas")
                .then(res => (this.knowledgeAreas = res.data))
                .catch(e => console.log(e));
        },
        loadTermCategories() {
            axios
                .get("/api/categories?type=" + TERM_TYPE)
                .then(res => (this.categories = res.data))
                .catch(e => console.log(e));
        },
        getDefaultTerm() {
            return {
                name: "",
                body: "",
                link: "",
                knowledgeAreas: [],
                categories: []
            };
        },
        resetNewTerm() {
            this.newTerm = this.getDefaultTerm();
            this.$refs.createForm.reset();
        },
        addTerm(e) {
            e.preventDefault();

            this.$refs.createForm.validate();

            axios
                .post("/api/terms", this.newTerm)
                .then(res => {
                    this.resetNewTerm();
                    this.dialogAdd = false;
                    this.loadTerms();
                })
                .catch(err => {
                    console.log(err);
                });
        },
        updateTerm() {
            axios
                .put("/api/terms/" + this.termToUpdate.id, {
                    name: this.termToUpdate.name,
                    body: this.termToUpdate.body
                })
                .then(res => {
                    this.loadTerms();
                    this.termToUpdate = false;
                })
                .catch(err => {
                    console.log(err);
                });
        },
        deleteTerm() {
            axios
                .delete("/api/terms/" + this.termToDelete.id)
                .then(res => {
                    this.loadTerms();
                    this.termToDelete = false;
                })
                .catch(err => {
                    console.log(err);
                });
        },
    },
    computed: {
        filteredTerms() {
            return this.terms.filter(term => {
                return term.body
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
        requiredField() {
            return [
                v => {
                    if (Array.isArray(v) && v.length == 0) {
                        return "Обязательное поле";
                    }

                    if (!v) {
                        return "Обязательное поле";
                    }

                    return true;
                }
            ];
        }
    }
};
</script>

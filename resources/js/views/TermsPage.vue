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

        <terms-create-dialog
            v-model="dialogAdd"
            :knowledge-areas="knowledgeAreas"
            :categories="categories"
            @created="termCreated"
        />

        <terms-edit-dialog
            v-model="termToUpdate"
            :knowledge-areas="knowledgeAreas"
            :categories="categories"
            @updated="termUpdated"
        />

        <terms-delete-dialog
            v-model="termToDelete"
            @deleted="termDeleted"
        />
        
    </v-content>
</template>
<script>
import WysiwygEditor from "../components/WysiwygEditor";
import rules from "../validation-rules";

import TermsCreateDialog from "./TermsCreateDialog";
import TermsEditDialog from "./TermsEditDialog";
import TermsDeleteDialog from "./TermsDeleteDialog";

export default {
    components: {
        "wysiwyg-editor": WysiwygEditor,
        "terms-create-dialog": TermsCreateDialog,
        "terms-edit-dialog": TermsEditDialog,
        "terms-delete-dialog": TermsDeleteDialog
    },
    data() {
        return {
            rules,
            valid: false,
            dialogAdd: false,
            categories: [],
            knowledgeAreas: [],
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
        termCreated(newTerm) {
            this.dialogAdd = false;
            this.loadTerms();
        },
        termUpdated(newTerm) {
            this.termToUpdate = null;
            this.loadTerms();
        },
        termDeleted(newTerm) {
            this.termToDelete = null;
            this.loadTerms();
        }
    },
    computed: {
        filteredTerms() {
            return this.terms.filter(term => {
                return term.body
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        }
    }
};
</script>

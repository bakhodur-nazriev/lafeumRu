<template>
    <v-content class="pa-0">
        <v-container>
            <v-row>
                <v-col cols="12">
                    <v-col cols="6" offset="3">
                        <v-text-field
                            solo
                            label="Поиск"
                            append-icon="mdi-magnify"
                            v-model="search"
                        ></v-text-field>
                    </v-col>
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
                                @click="termToUpdate = item"
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
                                <v-icon dark>
                                    mdi-delete
                                </v-icon>
                            </v-btn>
                        </template>
                    </v-data-table>
                    <div class="text-center pt-2">
                        <v-pagination v-model="page" :length="pageCount"></v-pagination>
                    </div>
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
            <span>Добавить термин</span>
        </v-tooltip>

        <!-- Add Item Dialog -->
        <v-dialog v-model="dialogAdd" width="600px">
            <v-card>
                <v-card-title class="primary white--text">
                    Создать Термин
                </v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-textarea
                                outlined
                                v-model="termBody"
                                name="body"
                                label="Добаить термин здесь"
                            >
                            </v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="addTerm()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="() => (dialogAdd = false)"
                    >Отмена
                    </v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Delete Item Dialog -->
        <v-dialog v-model="dialogDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center"
                >Вы действительно хотите удалить это терм ?
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
        <v-dialog v-model="dialogUpdate" width="600px">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить Термин
                </v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-textarea
                                outlined
                                label="Изменить термин здесь"
                                :value="termToUpdate.body"
                            >
                            </v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="updateTerm()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="dialogUpdate = false"
                    >Отмена
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Show Quote Dialog -->
        <v-dialog v-model="dialogShowTerm"></v-dialog>
    </v-content>
</template>

<script>
    export default {
        data() {
            return {
                dialogAdd: false,
                dialogDelete: false,
                dialogUpdate: false,
                dialogShowTerm: false,
                termBody: "",
                terms: [],
                search: "",
                page: 1,
                pageCount: 2,
                itemsPerPage: 12,
                termToDelete: {body: null},
                termToUpdate: {body: null},
                headers: [
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
                        body: this.termBody
                    })
                    .then(res => {
                        console.log(res);
                        this.loadTerms();
                        this.dialogAdd = false;
                    })
                    .catch(err => {
                        console.log(err.res.data);
                    });
            },
            updateTerm() {
                axios
                    .put("/api/terms/" + this.termToUpdate.id, {
                        body: this.terms.body
                    })
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
            }
        },

        watch: {
            termToUpdate(value) {
                if (value) {
                    this.dialogUpdate = true;
                } else {
                    this.dialogUpdate = false;
                }
            },

            termToDelete(value) {
                if (value) {
                    this.dialogDelete = true;
                } else {
                    this.dialogDelete = false;
                }
            }
        },

        computed: {
            filteredTerms() {
                return this.terms.filter(term => {
                    return term.body.toLowerCase().includes(this.search.toLowerCase());
                });
            }
        }
    };
</script>


<template>
    <v-content class="pa-0">
        <v-container fluid>
            <v-row>
                <v-col cols="12">
                    <v-text-field
                        solo
                        label="Поиск"
                        append-icon="mdi-magnify"
                    ></v-text-field>
                    <v-data-table
                        :headers="headers"
                        :items="quotes"
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
                                @click="dialogUpdate = !dialogUpdate"
                            >
                                <v-icon dark>mdi-pen</v-icon>
                            </v-btn>
                            <v-btn
                                fab
                                dark
                                small
                                color="primary"
                                elevation="2"
                                @click="dialogDelete = !dialogDelete"
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
            <span>Добавить цитату</span>
        </v-tooltip>
        <!-- Delete Item Dialog -->
        <v-dialog v-model="dialogDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center"
                >Вы действительно хотите удалить эту цитату ?
                </v-card-title
                >
                <v-card-actions class="justify-center">
                    <v-btn color="green darken-1" dark @click="dialogDelete = false">
                        Не
                    </v-btn>
                    <v-btn color="red darken-1" dark @click="dialogDelete = false">
                        Ҳа
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Add Item Dialog -->
        <v-dialog v-model="dialogAdd" width="600px">
            <v-card>
                <v-card-title class="primary white--text">
                    Создать Цитату
                </v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-select
                                :items="categoriesItem"
                                label="Категории"
                                dense
                            ></v-select>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                name="input-7-1"
                                label="Добаить цитату здесь"
                            ></v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn
                        dark
                        color="green"
                        @click="addQuote"
                    >Сохранить
                    </v-btn>
                    <v-btn
                        dark
                        color="error"
                        @click="() => dialogAdd = false"
                    >Отмена
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Update Item Dialog -->
        <v-dialog v-model="dialogUpdate" width="600px">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить Цитату
                </v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-select
                                :items="categoriesItem"
                                label="Категории"
                                dense
                            ></v-select>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                name="input-7-1"
                                label="Изменить цитату здесь"
                            ></v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn
                        dark
                        color="green"
                        @click="dialogUpdate = false"
                    >Сохранить
                    </v-btn>
                    <v-btn
                        dark
                        color="error"
                        @click="dialogUpdate = false"
                    >Отмена
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Show Quote Dialog -->
        <v-dialog v-model="dialogShowQuote">

        </v-dialog>
    </v-content>
</template>

<script>
    export default {
        data() {
            return {
                quotes: [],
                page: 1,
                pageCount: 2,
                pagination: {},
                dialogShowQuote: false,
                dialogAdd: false,
                dialogDelete: false,
                dialogUpdate: false,
                itemsPerPage: 12,
                editedIndex: -1,
                categoriesItem: ['qwe', 'asd', 'zxc'],
                headers: [
                    {text: '№', value: 'id', sortable: false},
                    {text: 'Цитата', value: 'body', align: 'left', sortable: false},
                    {text: 'Автор', value: 'author.name', align: 'center', sortable: false},
                ],
            }
        },
        mounted() {
            console.log(this.loadQuotes());
        },
        methods: {
            loadQuotes() {
                axios.get('/api/quotes').then(res => {
                    this.quotes = res.data;
                }).catch(err => {
                    console.log(err);
                });
            },

            deleteQuote() {
                axios.delete('/api/quotes/{id}').then(res => {
                    this.quotes = res.data;
                }).catch(err => {
                    console.log(err);
                });
            },

            addQuote() {
                axios.post('/api/quotes/', {
                    'body': this.quotes.body
                }).then(res => {
                    console.log(res);
                    this.dialogAdd = false;
                }).catch((err) => {
                    console.log(err.res.data)
                });
            }
        },
    }
</script>


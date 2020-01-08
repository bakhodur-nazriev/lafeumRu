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
                        >
                        </v-text-field>
                    </v-col>
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
                                outlined
                                @click="authorToShow = item"
                            >
                                <v-icon dark>
                                    mdi-eye
                                </v-icon>
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
                                :items="authors"
                                item-value="id"
                                item-text="name"
                                label="Категории"
                                dense
                            >
                            </v-select>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                name="input-7-1"
                                label="Добаить цитату здесь"
                            >
                            </v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn
                        dark
                        color="green"
                        @click=""
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
        <!-- Delete Item Dialog -->
        <v-dialog v-model="dialogDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center"
                >Вы действительно хотите удалить эту цитату ?
                </v-card-title
                >
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
                    Изменить Цитату
                </v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-select
                                :items="authors"
                                item-value="id"
                                item-text="name"
                                label="Категории"
                                dense
                            >
                            </v-select>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                name="input-7-1"
                                label="Изменить цитату здесь"
                            >
                            </v-textarea>
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
                search: '',
                authors: [],
                page: 1,
                pageCount: 2,
                authorToDelete: null,
                dialogAdd: false,
                dialogShowQuote: false,
                dialogDelete: false,
                dialogUpdate: false,
                itemsPerPage: 12,
                categoriesItem: ['qwe', 'asd', 'zxc'],
                headers: [
                    {
                        text: '№',
                        value: 'id',
                        align: 'center',
                        sortable: false
                    },
                    {
                        text: 'Имя',
                        align: 'center',
                        value: 'name'
                    },
                    {
                        text: 'Фото',
                        value: 'photo',
                        align: 'center',
                        sortable: false
                    },
                    {
                        text: 'Биография',
                        value: 'biography',
                        align: 'center',
                        sortable: false
                    },
                    {
                        text: 'Дейсвтия',
                        value: 'action',
                        align: 'center',
                        width: '160px',
                        sortable: false
                    }
                ]
            }
        },
        mounted() {
            this.loadAuthors();
        },
        methods: {
            loadAuthors() {
                axios.get('/api/authors').then(res => {
                    this.authors = res.data;
                }).catch(err => {
                    console.log(err);
                });
            },

            // addAuthor() {
            //     axios.post('/api/authors/', {
            //         'body': this.authors.body
            //     }).then(res => {
            //         console.log(res);
            //         this.dialogAdd = false;
            //     }).catch((err) => {
            //         console.log(err.res.data)
            //     });
            // }

            deleteAuthor() {
                axios.delete('/api/authors/' + this.authorToDelete.id).then(res => {
                    this.loadAuthors();
                    this.dialogDelete = false;
                }).catch(err => {
                    console.log(err);
                });
            },
        },

        watch: {
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
                return this.authors.filter((authors) => {
                    return authors.name.toLowerCase().includes(this.search.toLowerCase());
                })
            }
        }
    }
</script>

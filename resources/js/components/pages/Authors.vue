<template>
    <v-content class="pa-0">
        <v-container>
            <v-row>
                <v-col cols="12">
                    <v-text-field
                        solo
                        label="Поиск"
                        append-icon="mdi-magnify"
                    ></v-text-field>
                    <v-data-table
                        :headers="headers"
                        :items="authors"
                        :items-per-page="itemsPerPage"
                        :page.sync="page"
                        @page-count="pageCount = $event"
                        hide-default-footer
                        class="elevation-1"
                    >
                        <template v-slot="authors">

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
                        @click="addAuthor"
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

    </v-content>
</template>

<script>
    export default {
        data() {
            return {
                authors: [],
                page: 1,
                pageCount: 2,
                dialogAdd: false,
                itemsPerPage: 12,
                categoriesItem: ['qwe', 'asd', 'zxc'],
                headers: [
                    {text: '№', value: 'id', sortable: false},
                    {text: 'Имя', value: 'name'},
                    // {text: 'Фото', value: 'photo', sortable: false},
                    {text: 'Биография', value: 'biography', sortable: false}
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

            deleteAuthor() {
                axios.delete('/api/authors/{id}').then(res => {
                    this.quotes = res.data;
                }).catch(err => {
                    console.log(err);
                });
            },

            addAuthor() {
                axios.post('/api/authors/', {
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

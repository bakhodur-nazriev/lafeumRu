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
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
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
    </v-content>
</template>

<script>
    export default {
        data() {
            return {
                authors: [],
                page: 1,
                pageCount: 2,
                itemsPerPage: 12,
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
            console.log(this.loadAuthors());
        },
        methods: {
            loadAuthors() {
                axios.get('/api/authors').then(res => {
                    this.authors = res.data;
                    console.log(this.quotes = res.data);
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

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
                        :items="knowledgeAreas"
                        :items-per-page="itemsPerPage"
                        :page.sync="page"
                        @page-count="pageCount = $event"
                        hide-default-footer
                        class="elevation-1"
                    >
                        <template v-slot="terms">

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
                knowledgeAreas: [],
                page: 1,
                pageCount: 2,
                itemsPerPage: 12,
                headers: [
                    {text: '№', value: 'id', sortable: false},
                    {text: 'Имя', value: 'name', sortable: false,},
                    {text: 'Описания', value: 'description', sortable: false,}
                ]
            }
        },
        mounted() {
            this.loadKnowledgeAreas();
        },
        methods: {
            loadKnowledgeAreas() {
                axios.get('/api/knowledge_areas').then(res => {
                    this.knowledgeAreas = res.data;
                }).catch(err => {
                    console.log(err);
                });
            },

            deleteTerms() {
                axios.delete('/api/knowledge_areas/{id}').then(res => {
                    this.knowledgeAreas = res.data;
                }).catch(err => {
                    console.log(err);
                });
            },

            addTerms() {
                axios.post('/api/knowledge_areas/', {
                    'body': this.knowledges.body
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

<style>
    .theme--light.v-data-table thead tr:last-child th {
        font-size: 15px;
        font-weight: bold;
    }
</style>

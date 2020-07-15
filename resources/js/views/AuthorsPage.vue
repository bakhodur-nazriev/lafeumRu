<template>
    <v-content class="pa-0">
        <v-container fluid>
            <v-row justify="center">
                <v-col md="6">
                    <v-text-field
                        solo
                        hide-details
                        class="mb-1"
                        label="Поиск"
                        append-icon="mdi-magnify"
                        v-model="search"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-data-table
                        :click="authorToDelete"
                        :headers="headers"
                        :items="filteredAuthors"
                        :items-per-page="itemsPerPage"
                        :page.sync="page"
                        @page-count="pageCount = $event"
                        hide-default-footer
                        class="elevation-2"
                        :loading="loadingAuthors"
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
                                @click="authorToUpdate = {...item}"
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
                                @click="authorToDelete = item"
                            >
                                <v-icon dark>mdi-delete</v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.biography="{ item }">
                            <div
                                v-html="item.biography"
                                class="my-3 three-line-truncate"
                            />
                        </template>
                        <template v-slot:item.photo="{ item }">
                            <v-avatar size="78" class="ma-1" v-if="item.photo">
                                <v-img
                                    :src="item.photo"
                                    :alt="item.name"
                                    max-width="6rem"
                                >
                                </v-img>
                            </v-avatar>
                        </template>
                    </v-data-table>
                    <v-col class="text-center mt-2">
                        <v-pagination
                            v-model="page"
                            :length="pageCount"
                            :total-visible="7"
                        >
                        </v-pagination>
                    </v-col>
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

        <authors-create-dialog
            v-model="dialogAdd"
            :groups="authorGroups"
            @created="authorCreated"
        />

        <authors-edit-dialog
            v-model="authorToUpdate"
            :groups="authorGroups"
            @updated="authorUpdated"
        />

        <authors-delete-dialog
            v-model="authorToDelete"
            @deleted="authorDeleted"
        />
    </v-content>
</template>

<script>
    import AuthorsCreateDialog from "./AuthorsCreateDialog";
    import AuthorsEditDialog from "./AuthorsEditDialog";
    import AuthorsDeleteDialog from "./AuthorsDeleteDialog";

    export default {
        components: {
            AuthorsCreateDialog,
            AuthorsEditDialog,
            AuthorsDeleteDialog
        },
        data() {
            return {
                search: "",
                authors: [],
                authorGroups: [],
                loadingAuthors: false,
                page: 1,
                pageCount: 2,
                authorToDelete: null,
                authorToUpdate: null,
                dialogAdd: false,
                itemsPerPage: 12,
                headers: [
                    {
                        text: "Имя",
                        value: "name",
                        sortable: false
                    },
                    {
                        text: "Биография",
                        value: "biography",
                        sortable: false
                    },
                    {
                        text: "Фото",
                        value: "photo",
                        align: "center",
                        sortable: false
                    },
                    {
                        text: "Дейсвтия",
                        value: "action",
                        align: "center",
                        width: "160px",
                        sortable: false
                    }
                ]
            };
        },
        mounted() {
            this.loadAuthors();
            this.loadAuthorGroups();
        },
        methods: {
            loadAuthors() {
                this.loadingAuthors = true;
                axios
                    .get("/api/authors")
                    .then(res => {
                        this.loadingAuthors = false;
                        this.authors = res.data;
                    })
                    .catch(err => {
                        this.loadingPhotos = false;
                        console.log(err);
                    });
            },
            loadAuthorGroups() {
                axios
                    .get("/api/author-groups")
                    .then(res => (this.authorGroups = res.data))
                    .catch(err => console.log(err));
            },
            authorCreated(newAuthor) {
                this.dialogAdd = false;
                this.loadAuthors();
            },
            authorUpdated(updated) {
                this.authorToUpdate = null;
                this.loadAuthors();
            },
            authorDeleted() {
                this.authorToDelete = null;
                this.loadAuthors();
            }
        },
        computed: {
            filteredAuthors() {
                return this.authors.filter(author => {
                    return author.name
                        .toLowerCase()
                        .includes(this.search.toLowerCase());
                });
            }
        }
    };
</script>

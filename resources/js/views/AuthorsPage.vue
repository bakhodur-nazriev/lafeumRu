<template>
    <v-content class="pa-0">
        <index-page-layout
            index-url="/api/authors"
            :table-headers="this.headers"
            add-label="Добавить автора"
            search-field="name"
            ref="indexPage"
            @click:item="authorClick"
            @add-item="addAuthor = true"
            @update-item="authorToUpdate = $event"
            @delete-item="quoteToDelete = $event"
        >
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
        </index-page-layout>

        <authors-create-dialog
            v-model="addAuthor"
            :groups="authorGroups"
            @created="authorCreated"
        />

        <authors-edit-dialog
            v-model="authorToUpdate"
            :groups="authorGroups"
            @updated="authorUpdated"
        />

        <authors-show-dialog
            :author="authorToShow"
            @close="authorToShow = null"
        />

        <authors-delete-dialog
            v-model="authorToDelete"
            @deleted="authorDeleted"
        />
    </v-content>
</template>

<script>
    import IndexPageLayout from "../components/IndexPageLayout";
    import AuthorsCreateDialog from "./AuthorsCreateDialog";
    import AuthorsEditDialog from "./AuthorsEditDialog";
    import AuthorsDeleteDialog from "./AuthorsDeleteDialog";
    import AuthorsShowDialog from "./AuthorsShowDialog"

    export default {
        components: {
            IndexPageLayout,
            AuthorsShowDialog,
            AuthorsCreateDialog,
            AuthorsEditDialog,
            AuthorsDeleteDialog
        },
        data() {
            return {
                authorGroups: [],
                authorToShow: null,
                authorToDelete: null,
                authorToUpdate: null,
                addAuthor: false,
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
                ]
            };
        },
        mounted() {
            this.loadAuthorGroups();
        },
        methods: {
            loadAuthorGroups() {
                axios
                    .get("/api/author-groups")
                    .then(res => (this.authorGroups = res.data))
                    .catch(err => console.log(err));
            },
            authorCreated(newAuthor) {
                this.addAuthor = false;
                this.$refs.indexPage.loadItems();
            },
            authorUpdated(updated) {
                this.authorToUpdate = null;
                this.$refs.indexPage.loadItems();
            },
            authorDeleted() {
                this.authorToDelete = null;
                this.$refs.indexPage.loadItems();
            },
            authorClick(author) {
                this.authorToShow = author;
            }
        }
    }
</script>

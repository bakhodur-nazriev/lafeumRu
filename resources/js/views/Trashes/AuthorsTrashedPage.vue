<template>
    <v-main class="pa-0">
        <index-page-layout
            no-actions
            ref="indexPage"
            search-field="name"
            add-label="Добавить автора"
            index-url="/api/authors-trashed"
            :table-headers="this.headers"
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
            <template v-slot:item.action="{ item }">
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-btn
                            fab
                            dark
                            small
                            v-on="on"
                            elevation="2"
                            color="green"
                            @click="authorToRestore = true"
                        >
                            <v-icon dark>mdi-arrow-left</v-icon>
                        </v-btn>
                    </template>
                    <span>Востановить</span>
                </v-tooltip>
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-btn
                            fab
                            dark
                            small
                            v-on="on"
                            elevation="2"
                            color="red"
                            @click="authorToForceDelete = true"
                        >
                            <v-icon dark>mdi-delete</v-icon>
                        </v-btn>
                    </template>
                    <span>Удалить безвазвратно</span>
                </v-tooltip>
            </template>
        </index-page-layout>

        <v-dialog v-model="showRestoreDialog" width="480">
            <v-card v-if="showRestoreDialog" class="pa-2">
                <v-card-title class="font-weight-regular headline text-center pa-2">
                    Вы действительно хотите востановить автора ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn dark color="green" @click="authorToRestore = null">Нет</v-btn>
                    <v-btn dark color="red" @click="restoreAuthor()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog v-model="showForceDeleteDialog" width="500">
            <v-card v-if="showForceDeleteDialog" class="pa-2">
                <v-card-title class="font-weight-regular headline text-center pa-2">
                    Вы действительно хотите безвозвратно удалить эту автора ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn dark color="green" @click="authorToForceDelete = null">Нет</v-btn>
                    <v-btn dark color="red" @click="forceDeleteAuthor()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-main>
</template>

<script>
import IndexPageLayout from "../../components/IndexPageLayout";

export default {
    components: {IndexPageLayout},
    data() {
        return {
            authorGroups: [],
            authorToRestore: null,
            authorToForceDelete: null,
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
        this.loadAuthorGroups();
    },
    methods: {
        loadAuthorGroups() {
            axios
                .get("/api/author-groups")
                .then(res => (this.authorGroups = res.data))
                .catch(err => console.log(err));
        },
        restoreAuthor() {
            axios
                .put("/api/author-trashed/" + this.authorToRestore.id)
                .then(res => (this.authorToRestore = false))
                .catch(err => console.log(err))
        },
        forceDeleteAuthor() {
            axios
                .delete("/api/author-trashed/" + this.authorToForceDelete.id)
                .then(res => (this.authorToForceDelete = false))
                .catch(err => console.log(err))
        }
    },
    computed: {
        showRestoreDialog: {
            get() {
                return this.authorToRestore;
            },
            set(v) {
                if (!v) {
                    this.authorToRestore = null;
                }
            }
        },
        showForceDeleteDialog: {
            get() {
                return this.authorToForceDelete;
            },
            set(v) {
                if (!v) {
                    this.authorToForceDelete = null;
                }
            }
        }
    }
}
</script>

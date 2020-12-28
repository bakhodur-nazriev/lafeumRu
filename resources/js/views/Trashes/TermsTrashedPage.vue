<template>
    <v-main class="pa-0">
        <index-page-layout
            no-actions
            ref="indexPage"
            search-field="body"
            index-url="/api/terms-trashed"
            :categories="categories"
            :table-headers="this.headers"
        >
            <template v-slot:item.body="{ item }">
                <div
                    v-html="item.body"
                    class="my-3 three-line-truncate"
                />
            </template>
            <template v-slot:item.knowledge="{ item }">
                <div
                    v-for="(know, i) in item.knowledge"
                    :key="i"
                >
                    {{ know.name }},
                </div>
            </template>
            <template v-slot:item.categories="{ item }">
                <div
                    v-for="(category, i) in item.categories"
                    :key="i"
                >
                    {{ category.name }},
                </div>
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
                            @click="termToRestore = true"
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
                            @click="termToForceDelete = true"
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
                    Вы действительно хотите востановить термин ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn dark color="green" @click="termToRestore = null">Нет</v-btn>
                    <v-btn dark color="red" @click="restoreTerm()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog v-model="showForceDeleteDialog" width="500">
            <v-card v-if="showForceDeleteDialog" class="pa-2">
                <v-card-title class="font-weight-regular headline text-center pa-2">
                    Вы действительно хотите безвозвратно удалить термин ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn dark color="green" @click="termToForceDelete = null">Нет</v-btn>
                    <v-btn dark color="red" @click="forceDeleteTerm()">Да</v-btn>
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
            termTypes: [],
            categories: [],
            knowledgeAreas: [],
            termToRestore: null,
            termToForceDelete: null,
            headers: [
                {
                    text: "Словарь",
                    value: "name"
                },
                {
                    text: "Термины",
                    value: "body",
                    class: "ma-3"
                },
                {
                    text: "Тип",
                    value: "term_type.name",
                    align: "center"
                },
                {
                    text: "Область знаний",
                    value: "knowledge",
                    align: "center"
                },
                {
                    text: "Рубрики",
                    value: "categories",
                    align: "center"
                },
                {
                    text: "Опубликовано",
                    value: "publish_at",
                    width: 160
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
        this.loadTermTypes();
    },
    methods: {
        loadTermTypes() {
            axios
                .get("/api/term-types")
                .then(res => (this.termTypes = res.data))
                .catch(e => console.log(e));
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
        restoreTerm() {
            axios
                .put("/api/term-trashed/" + this.termToRestore.id)
                .then(res => {
                    this.termToRestore = false;
                    this.$refs.indexPage.loadItems();
                })
                .catch(err => console.log(err))
        },
        forceDeleteTerm() {
            axios
                .delete("/api/term-trashed/" + this.termToForceDelete.id)
                .then(res => {
                    this.termToForceDelete = false;
                    this.$refs.indexPage.loadItems();
                })
                .catch(err => console.log(err))
        }
    },
    computed: {
        showRestoreDialog: {
            get() {
                return this.termToRestore;
            },
            set(v) {
                if (!v) {
                    this.termToRestore = null;
                }
            }
        },
        showForceDeleteDialog: {
            get() {
                return this.termToForceDelete;
            },
            set(v) {
                if (!v) {
                    this.termToForceDelete = null;
                }
            }
        }
    },
}
</script>

<template>
    <v-container fluid>
        <v-row justify="center">
            <v-card class="col-lg-12 col-xl-8 pa-4" v-if="categories.length">
                <h2>Категории</h2>
                <Tree v-model="categories">
                    <div
                        class="category-tree-node"
                        :style="{ cursor: 'pointer' }"
                        slot-scope="{ node, tree, path }"
                        @click="categoryToShow = node"
                    >
                        <v-btn
                            v-if="node.children.length"
                            icon
                            x-small
                            color="black"
                            @click.stop="tree.toggleFold(node, path)"
                        >
                            <v-icon small>{{
                                node.$folded
                                    ? "mdi-chevron-down"
                                    : "mdi-chevron-up"
                            }}</v-icon>
                        </v-btn>
                        <span>
                            {{ node.name }}
                        </span>
                    </div>
                </Tree>
                <div class="mt-3 d-flex">
                    <v-spacer />
                    <v-btn
                        color="green accent-4 white--text"
                        @click="saveCategoryTree"
                    >
                        Сохранить
                    </v-btn>
                </div>
            </v-card>
            <v-progress-circular indeterminate color="primary" v-else />
        </v-row>
        <v-dialog v-model="showDialog" width="600">
            <v-card v-if="showDialog">
                <v-card-title class="headline pr-2">
                    {{ categoryToShow.name }}
                    <v-spacer />
                    <v-btn icon @click="categoryToEdit = {...categoryToShow}">
                        <v-icon small>mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn icon>
                        <v-icon small>mdi-delete</v-icon>
                    </v-btn>
                </v-card-title>

                <v-card-text>
                    {{ categoryToShow.description }}
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="primary darken-1"
                        text
                        @click="categoryToShow = null"
                    >
                        Закрыть
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="showEditDialog" width="600">
            <v-card v-if="showEditDialog">
                <v-card-title class="headline pr-2">
                    Изменение категории
                </v-card-title>

                <v-card-text>
                    <v-text-field 
                        label="Название"
                        outlined
                        v-model="categoryToEdit.name"
                    />
                    <v-textarea
                        label="Описание"
                        v-model="categoryToEdit.description"
                        outlined
                    />
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="green darken-1"
                        text
                        @click="categoryToEdit = null"
                    >
                        Сохранить
                    </v-btn>
                    <v-btn
                        color="primary darken-1"
                        text
                        @click="categoryToEdit = null"
                    >
                        Отмена
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<script>
import "he-tree-vue/dist/he-tree-vue.css";
import { Tree, Draggable, Fold, foldAll, getPureTreeData } from "he-tree-vue";

export default {
    components: {
        Tree: Tree.mixPlugins([Draggable, Fold])
    },
    data() {
        return {
            categories: [],
            categoryToShow: null,
            categoryToEdit: null
        };
    },
    mounted() {
        this.loadCategories();
    },
    computed: {
        showDialog: {
            get() {
                return this.categoryToShow;
            },
            set(v) {
                if (!v) {
                    this.categoryToShow = null;
                }
            }
        },
        showEditDialog: {
            get() {
                return this.categoryToEdit;
            },
            set(v) {
                if (!v) {
                    this.categoryToEdit = null;
                } else {
                    this.categoryToShow = null;
                }
            }
        }
    },
    methods: {
        loadCategories() {
            let categoryType = this.$route.meta.type;
            axios
                .get("/api/categories?type=" + categoryType)
                .then(({ data }) => this.setCategories(data))
                .catch(e => console.log(e));
        },
        saveCategoryTree() {
            let categoryType = this.$route.meta.type;
            axios
                .put("/api/categories?type=" + categoryType, {
                    categories: getPureTreeData(this.categories)
                })
                .then(({ data }) => this.setCategories(data))
                .catch(e => console.log(e));

            this.setCategories([]);
        },
        setCategories(categories) {
            this.categories = categories;
            foldAll(this.categories);
        }
    },
    watch: {
        $route(route) {
            this.loadCategories();
        }
    }
};
</script>

<style>
.he-tree .tree-node {
    padding: 0;
}
.category-tree-node {
    padding: 5px;
}
</style>

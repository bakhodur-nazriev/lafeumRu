<template>
    <v-content class="pa-0">
        <v-container fluid>
            <v-row justify="center">
                <v-card
                    class="col-lg-12 col-xl-8 pa-4"
                    v-if="!categoriesLoading"
                >
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
                            outlined
                            @click="saveCategoryTree"
                        >
                            Сохранить структуру
                        </v-btn>
                    </div>
                </v-card>
                <v-progress-circular indeterminate color="primary" v-else />
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
                    @click="showCreateDialog = true"
                >
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>
            <span>Добавить фото</span>
        </v-tooltip>

        <category-create-dialog
            :show="showCreateDialog"
            :categoryType="categoryType"
            @close="showCreateDialog = false"
            @created="categoryCreated"
        />

        <category-show-dialog
            :category="categoryToShow"
            @close="categoryToShow = null"
            @edit="editCategory"
            @delete="deleteCategory"
        />

        <category-edit-dialog
            :category="categoryToEdit"
            @close="categoryToEdit = null"
            @updated="categoryUpdated"
        />

        <category-delete-dialog
            :category="categoryToDelete"
            @close="categoryToDelete = null"
            @deleted="categoryDeleted"
        />
    </v-content>
</template>

<script>
import "he-tree-vue/dist/he-tree-vue.css";
import { Tree, Draggable, Fold, foldAll, getPureTreeData } from "he-tree-vue";

import CategoryCreateDialog from "./CategoryCreateDialog";
import CategoryShowDialog from "./CategoryShowDialog";
import CategoryEditDialog from "./CategoryEditDialog";
import CategoryDeleteDialog from "./CategoryDeleteDialog";

export default {
    components: {
        Tree: Tree.mixPlugins([Draggable, Fold]),
        "category-create-dialog": CategoryCreateDialog,
        "category-show-dialog": CategoryShowDialog,
        "category-edit-dialog": CategoryEditDialog,
        "category-delete-dialog": CategoryDeleteDialog
    },
    data() {
        return {
            categories: [],
            showCreateDialog: false,
            categoriesLoading: false,
            categoryType: this.$route.meta.type,
            categoryToShow: null,
            categoryToEdit: null,
            categoryToDelete: null
        };
    },
    mounted() {
        this.loadCategoriesTree();
    },
    methods: {
        loadCategoriesTree() {
            this.categoriesLoading = true;
            axios
                .get("/api/categories?tree&type=" + this.categoryType)
                .then(({ data }) => {
                    this.categoriesLoading = false;
                    this.setCategories(data)
                })
                .catch(e => {
                    this.categoriesLoading = false;
                    console.log(e)
                });
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
        },
        editCategory(category) {
            this.categoryToEdit = { ...category };
            this.categoryToShow = null;
        },
        deleteCategory(category) {
            this.categoryToDelete = { ...category };
            this.categoryToShow = null;
        },
        categoryCreated(newCategory){
            this.showCreateDialog = false;
            this.loadCategoriesTree();
        },
        categoryUpdated(updatedCategory) {
            this.loadCategoriesTree();
            this.categoryToEdit = null;
        },
        categoryDeleted(deletedCategory) {
            this.loadCategoriesTree();
            this.categoryToDelete = null;
        }
    },
    watch: {
        $route(route) {
            this.categoryType = route.meta.type;
            this.loadCategoriesTree();
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

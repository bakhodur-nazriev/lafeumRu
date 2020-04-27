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

        <category-show-dialog
            :category="categoryToShow"
            @close="categoryToShow = null"
            @edit="editCategory"
            @delete="deleteCategory"
        />

        <category-edit-dialog
            :category="categoryToEdit"
            @close="categoryToEdit = null"
            @edited="saveEditedCategory"
        />

        <category-delete-dialog
            :category="categoryToDelete"
            @close="categoryToDelete = null"
            @confirmed="deleteConfirmedCategory"
        />

    </v-container>
</template>

<script>
import "he-tree-vue/dist/he-tree-vue.css";
import { Tree, Draggable, Fold, foldAll, getPureTreeData } from "he-tree-vue";

import CategoryShowDialog from "./CategoryShowDialog";
import CategoryEditDialog from "./CategoryEditDialog";
import CategoryDeleteDialog from "./CategoryDeleteDialog";

export default {
    components: {
        Tree: Tree.mixPlugins([Draggable, Fold]),
        "category-show-dialog": CategoryShowDialog,
        "category-edit-dialog": CategoryEditDialog,
        "category-delete-dialog": CategoryDeleteDialog
    },
    data() {
        return {
            categories: [],
            categoryToShow: null,
            categoryToEdit: null,
            categoryToDelete: null
        };
    },
    mounted() {
        this.loadCategories();
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
        },
        editCategory(category) {
            this.categoryToEdit = { ...category };
            this.categoryToShow = null;
        },
        deleteCategory(category) {
            this.categoryToDelete = { ...category };
            this.categoryToShow = null;
        },
        saveEditedCategory(editedCategory){
            console.log("EDITED:", editedCategory);
        },
        deleteConfirmedCategory(confirmedCategory){
            console.log("CONFIRMED:", confirmedCategory);
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

<template>
    <v-main class="pa-0">
        <v-container fluid>
            <v-row justify="center">
                <v-card
                    class="col-lg-12 col-xl-8 pa-4"
                    v-if="!categoriesLoading"
                >
                    <div class="d-flex mb-3">
                        <v-spacer/>
                        <v-btn
                            color="green accent-4 white--text"
                            outlined
                            small
                            @click="saveCategoryTree"
                        >
                            Сохранить структуру
                        </v-btn>
                    </div>
                    <tree-view
                        :tree-data="categories"
                        item-text="name"
                        ref="treeView"
                        @node-click="onCategoryClick"
                    />
                </v-card>
                <v-progress-circular indeterminate color="primary" v-else/>
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
            <span>Добавить категорию</span>
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
            @showPage="goToCategoryPage"
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
    </v-main>
</template>

<script>
import TreeView from "../../components/TreeView";
import CategoryCreateDialog from "./CategoryCreateDialog";
import CategoryShowDialog from "./CategoryShowDialog";
import CategoryEditDialog from "./CategoryEditDialog";
import CategoryDeleteDialog from "./CategoryDeleteDialog";

export default {
    components: {
        TreeView,
        CategoryCreateDialog,
        CategoryShowDialog,
        CategoryEditDialog,
        CategoryDeleteDialog
    },
    data() {
        return {
            categories: [],
            categoryToShow: null,
            categoryToEdit: null,
            categoryToDelete: null,
            showCreateDialog: false,
            categoriesLoading: false,
            categoryType: this.$route.meta.type,
        };
    },
    mounted() {
        this.loadCategoriesTree();
    },
    methods: {
        goToCategoryPage(category) {
            switch (this.categoryType) {
                case "App\\Quote":
                    window.open(`/quotes/${category.slug}`, '_blank');
                    break;
                case "App\\Term":
                    window.open(`/terms/${category.slug}`, '_blank');
                    break;
                case "App\\Video":
                    window.open(`/videos/${category.slug}`, '_blank');
                    break;
            }
        },
        onCategoryClick(category) {
            this.categoryToShow = category;
        },
        loadCategoriesTree() {
            this.categoriesLoading = true;
            axios
                .get("/api/categories?tree&type=" + this.categoryType)
                .then(({data}) => {
                    this.categoriesLoading = false;
                    this.setCategories(data);
                })
                .catch(e => {
                    this.categoriesLoading = false;
                    console.log(e);
                });
        },
        saveCategoryTree() {
            this.categoriesLoading = true;
            let categoryTree = this.$refs.treeView.getTree();

            axios
                .put("/api/categories?type=" + this.categoryType, {
                    categories: categoryTree
                })
                .then(({data}) => {
                    this.categoriesLoading = false;
                    this.setCategories(data);
                })
                .catch(e => {
                    this.categoriesLoading = false;
                    console.log(e);
                });

            this.setCategories([]);
        },
        setCategories(categories) {
            this.categories = categories;
        },
        editCategory(category) {
            this.categoryToEdit = {...category};
            this.categoryToShow = null;
        },
        deleteCategory(category) {
            this.categoryToDelete = {...category};
            this.categoryToShow = null;
        },
        categoryCreated(newCategory) {
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

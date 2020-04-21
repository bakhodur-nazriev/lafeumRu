<template>
    <v-container fluid>
        <v-row justify="center">
            <v-card class="col-lg-12 col-xl-8 pa-4" v-if="categories.length">
                <h2>Категории</h2>
                <Tree v-model="categories">
                    <div
                        :style="{ cursor: 'pointer' }"
                        slot-scope="{ node, tree, path }"
                        @click="tree.toggleFold(node, path)"
                    >
                        <v-icon
                            class="mr-2"
                            v-if="node.children.length"
                            small
                            color="black"
                        >
                            {{ node.$folded ? "mdi-plus" : "mdi-minus" }}
                        </v-icon>
                        {{ node.name }}
                    </div>
                </Tree>
                <div class="mt-3 d-flex">
                    <v-spacer/>
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
        }
    },
    watch: {
        $route(route) {
            this.loadCategories();
        }
    }
};
</script>

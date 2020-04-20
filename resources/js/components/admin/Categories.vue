<template>
    <v-container fluid>
        <v-row justify="center">
            <v-card class="col-lg-12 col-xl-8 pa-4" v-if="categories">
                <!-- <NestedCategories :categories="categories"/> -->
                <Tree v-model="categories">
                    <div
                        :style="{ cursor: 'pointer' }"
                        slot-scope="{ node, tree, path }"
                    >
                        <v-icon
                            class="mr-2"
                            v-if="node.children.length"
                            @click="tree.toggleFold(node, path)"
                            small
                            color="black"
                        >
                            {{ node.$folded ? "mdi-plus" : "mdi-minus" }}
                        </v-icon>
                        {{ node.name }}
                    </div>
                </Tree>

                <v-card-actions>
                    <v-btn
                        color="green accent-4 white--text"
                        @click="saveCategoryTree"
                    >
                        Сохранить
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-row>
    </v-container>
</template>

<script>
import NestedCategories from "./NestedCategories";
import "he-tree-vue/dist/he-tree-vue.css";
import { Tree, Draggable, Fold, foldAll, getPureTreeData } from "he-tree-vue";

export default {
    components: {
        NestedCategories,
        Tree: Tree.mixPlugins([Draggable, Fold])
    },
    data() {
        return {
            categories: []
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
            axios
                .put("/api/categories", {
                    categories: getPureTreeData(this.categories)
                })
                .then(({ data }) => this.setCategories(data))
                .catch(e => console.log(e));
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

<template>
    <v-container fluid>
        <v-row justify="center">
            <v-card class="col-lg-12 col-xl-8 p-0">
                <draggable v-model="categories" class="bigger-area">
                    <transition-group name="list-complete">
                        <div
                            v-for="(category, i) in categories"
                            :key="i"
                            class="pa-3 mb-2 teal white--text"
                            @dragend="dragged"
                        >
                            {{ category.name }}
                        </div>
                    </transition-group>
                </draggable>
                <!-- <ul>
                    <Category
                        v-for="(category, i) in categories"
                        :key="i"
                        :category="category"
                    />
                </ul> -->
            </v-card>
        </v-row>
    </v-container>
</template>

<script>
import Category from "./Category";
import draggable from "vuedraggable";

export default {
    components: {
        Category,
        draggable
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
                .then(({ data }) => (this.categories = data))
                .catch(e => console.log(e));
        },
        dragged(){
            console.log(arguments);
        }
    },
    watch: {
        $route(route) {
            this.loadCategories();
        }
    }
};
</script>

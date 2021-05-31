<template>
    <v-card flat rounded="lg" class="mb-8">
        <v-card-subtitle class="d-flex px-6 py-3">
            <v-spacer></v-spacer>
            <a class="grey--text text-decoration-none" :href="item.post.id">
                #{{ item.post.id }}
            </a>
        </v-card-subtitle>

        <v-divider class="m-0 grey lighten-3"></v-divider>

        <v-card-text class="px-6 py-3">
            <p class="subtitle-1">{{ item.body }}</p>
            <div class="mb-2">
                <a
                    class="d-flex align-items-center text-decoration-none author-show-link"
                    :href="`/authors/` + item.author.slug"
                >
                    <v-icon color="grey lighten-1">mdi-account</v-icon>
                    <h5 class="mb-0 ml-1 subtitle-1">
                        {{ item.author.name }}
                    </h5>
                </a>
            </div>
            <div class="categories-block">
                <a
                    class="mr-2 grey--text text-decoration-none"
                    v-for="(category, i) in item.categories"
                    :key="i"
                    :href="`/quotes/` + category.slug"
                >
                    {{ category.name }}
                </a>
            </div>
        </v-card-text>
        <v-divider class="m-0 grey lighten-3"></v-divider>
        <v-card-actions class="px-4 py-2">
            <!--            <div>
                            <v-btn icon>
                                <v-icon color="grey lighten-1"> mdi-heart</v-icon>
                            </v-btn>
                            <span>45</span>
                            <v-btn icon>
                                <v-icon color="grey lighten-1"> mdi-bookmark</v-icon>
                            </v-btn>
                            <span>45</span>
                        </div>-->
            <v-spacer></v-spacer>
            <share-button :post="item.post"></share-button>
        </v-card-actions>
    </v-card>
</template>

<script>
import ShareButton from "../../../components/ShareButton";

export default {
    props: ["quote"],
    components: {
        ShareButton
    },
    data() {
        return {
            item: this.quote,
        };
    },
    // created() {
    //     console.log(this.quote);
    // }
};
</script>

<style scoped>
.author-show-link {
    width: fit-content;
    color: #000;
}

.author-show-link:hover {
    color: #04718c;
}
</style>

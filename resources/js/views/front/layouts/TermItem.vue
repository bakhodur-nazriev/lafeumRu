<template>
    <v-card
        flat
        rounded="lg"
        class="mb-8"
    >
        <v-card-subtitle class="d-flex px-5 pa-4">
            <div class="d-flex" v-if="item.term_type.name === `Термины научного мира`">
                <v-img
                    v-for="icon in 3"
                    :key="icon"
                    src="/img/icons/atom.svg"
                    width="20"
                    class="mr-1"
                >
                </v-img>
            </div>
            <div v-else>
                <span>{{ item.term_type.name }}</span>
            </div>

            <v-spacer></v-spacer>

            <a
                class="grey--text text-decoration-none"
                :href="item.post.id"
            >
                #{{ item.post.id }}
            </a>
        </v-card-subtitle>

        <v-divider class="m-0 grey lighten-3"></v-divider>

        <v-card-text class="px-6 py-4">
            <p class="subtitle-1" v-html="item.body"></p>
            <div class="categories-block mt-2">
                <a
                    class="mr-2 grey--text text-decoration-none"
                    v-for="(termCategories ,i) in item.categories"
                    :key="i"
                    :href="`/terms/` + termCategories.slug"
                >
                    {{ termCategories.name }}
                </a>
            </div>
        </v-card-text>
        <v-divider class="m-0 grey lighten-3"></v-divider>
        <v-card-actions class="px-4 py-2">
            <!--            <div>-->
            <!--                <v-btn icon>-->
            <!--                    <v-icon color="grey lighten-1">-->
            <!--                        mdi-heart-->
            <!--                    </v-icon>-->
            <!--                </v-btn>-->
            <!--                <span>45</span>-->
            <!--                <v-btn icon>-->
            <!--                    <v-icon color="grey lighten-1">-->
            <!--                        mdi-bookmark-->
            <!--                    </v-icon>-->
            <!--                </v-btn>-->
            <!--                <span>45</span>-->
            <!--            </div>-->
            <v-spacer></v-spacer>
            <share-button :post="item.post"></share-button>
        </v-card-actions>
    </v-card>
</template>

<script>
import ShareButton from "../../../components/ShareButton";

export default {
    props: ["term"],
    components: {ShareButton},
    name: "TermItem",
    data() {
        return {
            item: this.term
        }
    },
}
</script>

<style scoped>
</style>

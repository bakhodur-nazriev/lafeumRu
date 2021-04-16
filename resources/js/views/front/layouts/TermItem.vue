<template>
    <v-card
        flat
        rounded="lg"
        class="mb-8"
    >
        <v-card-subtitle class="d-flex p-4">
            <div class="d-flex" v-if="term.term_type.name === `Термины научного мира`">
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
                <span>{{ term.term_type.name }}</span>
            </div>

            <v-spacer></v-spacer>

            <a
                class="grey--text text-decoration-none"
                :href="term.post.id"
            >
                #{{ term.post.id }}
            </a>
        </v-card-subtitle>

        <v-divider class="m-0 grey lighten-3"></v-divider>

        <v-card-text class="p-4">
            <p class="subtitle-1" v-html="term.body"></p>
            <div class="categories-block">
                <a
                    class="mx-1 grey--text text-decoration-none"
                    v-for="(termCategories ,i) in term.categories"
                    :key="i"
                    :href="`/quotes/` + termCategories.slug"
                >{{ termCategories.name }}</a>
            </div>
        </v-card-text>

        <v-divider class="m-0 grey lighten-3"></v-divider>

        <v-card-actions class="px-5 py-4">
            <div>
                <v-btn icon>
                    <v-icon color="grey lighten-1">
                        mdi-heart
                    </v-icon>
                </v-btn>
                <span>45</span>
                <v-btn icon>
                    <v-icon color="grey lighten-1">
                        mdi-bookmark
                    </v-icon>
                </v-btn>
                <span>45</span>
            </div>
            <v-spacer></v-spacer>
            <div>
                <v-btn icon color="grey lighten-1">
                    <v-icon>mdi-share-variant</v-icon>
                </v-btn>
            </div>
        </v-card-actions>
    </v-card>
</template>

<script>
export default {
    props: ["term"],
    name: "TermItem",
    data() {
        return {}
    }
}
</script>

<style scoped>

</style>

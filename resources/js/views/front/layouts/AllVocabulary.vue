<template>
    <div>
        <v-row justify="center" class="px-0">
            <v-col
                v-for="(vocabulary, i) in terms"
                :key="i"
                class="fill-height col-md-6 col-12"
            >
                <v-card rounded="lg" class="px-7 py-5" flat>
                    <v-card-text
                        v-for="(term, i) in vocabulary"
                        :key="i"
                        class="pa-0"
                    >
                        <list-of-vocabulary :item="term"></list-of-vocabulary>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <infinite-loading @disance="1" @infinite="getVocabulary">
            <div slot="no-results"></div>
            <div slot="no-more"></div>
        </infinite-loading>
    </div>
</template>

<script>
import ListOfVocabulary from "../ListOfChildren/ListOfVocabulary";
import InfiniteLoading from "vue-infinite-loading";

export default {
    components: {ListOfVocabulary, InfiniteLoading},
    name: "allVocabulary",
    props: ["terms", "getVocabulary"],
    data() {
        return {}
    },
    methods: {},
}
</script>

<style scoped>

</style>

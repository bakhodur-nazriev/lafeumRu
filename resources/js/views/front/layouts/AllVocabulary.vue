<template>
    <v-col class="fill-height pa-0">
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
    </v-col>
</template>

<script>
import ListOfVocabulary from "../ListOfChildren/ListOfVocabulary";

export default {
    components: {ListOfVocabulary},
    name: "allVocabulary",
    props: ["terms"],
}
</script>

<style scoped>

</style>

<template>
    <v-col xl="5" lg="6">
        <div>
            <h5 class="text-uppercase font-weight-regular py-4 mb-0">
                {{ currentKnowledge.name }}
            </h5>
            <p v-if="currentKnowledge.description" class="mb-4">
                {{ currentKnowledge.description }}
            </p>
        </div>
        <div v-for="(knowledge, i) in currentKnowledge.terms.data" :key="i">
            <term-item :term="knowledge"></term-item>
        </div>
    </v-col>
</template>

<script>
import TermItem from "../layouts/TermItem.vue";

export default {
    components: {
        TermItem,
    },
    name: "KnowledgeArea",
    props: ["currentKnowledgeArea"],
    data() {
        return {
            currentKnowledge: this.currentKnowledgeArea,
        };
    },
};
</script>

<style scoped>
</style>

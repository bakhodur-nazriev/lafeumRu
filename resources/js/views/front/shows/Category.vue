<template>
    <v-col xl="5" lg="6">
        <h5 class="text-uppercase font-weight-regular py-4">
            {{ category.name }}
        </h5>
        <p>{{ category.description }}</p>
        <div v-for="(item, i) in category.categoriables.data" :key="i">
            <quote-item
                v-if="category.type == 'App\\Quote'"
                :quote="item"
            ></quote-item>
            <term-item
                v-if="category.type == 'App\\Term'"
                :term="item"
            ></term-item>
            <video-item
                v-if="category.type == 'App\\Video'"
                :video="item"
            ></video-item>
        </div>
    </v-col>
</template>

<script>
import QuoteItem from "../layouts/QuoteItem.vue";
import TermItem from "../layouts/TermItem.vue";
import VideoItem from "../layouts/VideoItem.vue";

export default {
    components: {
        QuoteItem,
        TermItem,
        VideoItem,
    },
    props: ["categoriables"],
    name: "Category",
    data() {
        return {
            category: this.categoriables,
        };
    },
    created() {
        for (const category of this.category.categoriables.data) {
            console.log(category);
        }
    },
};
</script>

<style scoped>
</style>

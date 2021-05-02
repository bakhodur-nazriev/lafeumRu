<template>
    <v-col xl="7" lg="8" class="pt-5">
        <quote-item :quote="post"></quote-item>
        <term-item :term="post"></term-item>
        <video-item :video="post"></video-item>
    </v-col>
</template>

<script>
import QuoteItem from "../layouts/QuoteItem.vue";
import TermItem from "../layouts/TermItem.vue";
import VideoItem from "../layouts/VideoItem.vue";

export default {
    name: "Post",
    props: ["post"],
    components: {
        QuoteItem,
        TermItem,
        VideoItem,
    },
    data() {
        return {};
    }
};
</script>

<style scoped>
</style>

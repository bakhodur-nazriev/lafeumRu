<template>
    <v-col xl="7" lg="8" class="pt-5">
        <quote-item v-if="post.post.postable_type == 'App\\Quote'" :quote="post"></quote-item>
        <term-item v-if="post.post.postable_type == 'App\\Term'" :term="post"></term-item>
        <video-item v-if="post.post.postable_type == 'App\\Video'" :video="post"></video-item>
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

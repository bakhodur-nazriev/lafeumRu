<template>
  <v-col xl="5" lg="6">
    <quote-item v-if="items.postable_type == 'App\\Quote'" :quote="item">
    </quote-item>
    <term-item v-if="items.postable_type == 'App\\Term'" :term="item">
    </term-item>
    <video-item v-if="items.postable_type == 'App\\Video'" :video="item">
    </video-item>
  </v-col>
</template>

<script>
import QuoteItem from "../layouts/QuoteItem.vue";
import TermItem from "../layouts/TermItem.vue";
import VideoItem from "../layouts/VideoItem.vue";

export default {
  name: "Post",
  props: ["post", "item"],
  components: {
    QuoteItem,
    TermItem,
    VideoItem,
  },
  data() {
    return {
      items: this.post,
    };
  },
  created() {
    console.log(this.item);
    // for (const post of this.post) {
    // }
  },
};
</script>

<style scoped>
</style>

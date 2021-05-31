<template>
    <v-col xl="8" lg="6">
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
        <v-col cols="12">
            <v-pagination
                v-model="pagination.current"
                :length="pagination.total"
                :total-visible="7"
                @input="onPageChange"
            ></v-pagination>
        </v-col>
        <scroller></scroller>
    </v-col>
</template>

<script>
import QuoteItem from "../layouts/QuoteItem.vue";
import TermItem from "../layouts/TermItem.vue";
import VideoItem from "../layouts/VideoItem.vue";
import Scroller from "../../../components/Scroller";

export default {
    components: {
        Scroller,
        QuoteItem,
        TermItem,
        VideoItem,
    },
    props: ["category"],
    name: "Category",
    data() {
        return {
            // category: [],
            loading: false,
            pagination: {
                current: 1,
                total: 0
            }
        };
    },
    methods: {
        getCategory() {
            this.loading = true;
            axios
                .get("/api/terms/" + this.category.slug)
                .then((res) => {
                    this.loading = false;
                    // this.category = res.data;
                    console.log();
                })
                .catch((err) => {
                    this.loading = false;
                    console.log(err);
                })
        },
        onPageChange() {
            window.scrollTo(0, 0);
            this.getCategory();
        }
    },
    mounted() {
        this.getCategory();
    },
    created() {
        console.log(this.category.slug);
    },
};
</script>

<style scoped>
</style>

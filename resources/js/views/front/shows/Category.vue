<template>
    <v-col xl="5" lg="6">
        <h5 class="text-uppercase font-weight-regular py-4 mb-0">{{ category.name }}</h5>
        <p class="mb-4">{{ category.description }}</p>

        <v-col cols="12" class="d-flex justify-center" v-if="loading">
            <v-progress-circular
                width="5"
                size="48"
                indeterminate
                color="primary"
            ></v-progress-circular>
        </v-col>
        <v-col
            v-else
            v-for="(item, i) in categoriables"
            :key="i"
            class="pa-0"
        >
            <quote-item
                v-if="category.type == 'App\\Quote'"
                :quote="item"
            >
            </quote-item>
            <term-item
                v-if="category.type == 'App\\Term'"
                :term="item"
            ></term-item>
            <video-item
                v-if="category.type == 'App\\Video'"
                :video="item"
            ></video-item>
            <!-- <vocabulary-->
            <!--     v-if="category.type == 'App\\Video'"-->
            <!--     :video="item"-->
            <!-- ></vocabulary>-->
        </v-col>
        <v-col cols="12">
            <v-pagination
                v-model="pagination.currentPage"
                :length="pagination.totalPage"
                :total-visible="7"
                @input="onPageChange"
            ></v-pagination>
        </v-col>
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
    name: "Category",
    data() {
        return {
            category: [],
            categoriables: [],
            windowUrl: window.location.pathname,
            loading: false,
            pagination: {
                currentPage: 1,
                totalPage: 0
            }
        };
    },
    methods: {
        getCategory() {
            this.loading = true;
            axios
                .get(`/api${this.windowUrl}?page=` + this.pagination.currentPage)
                .then((res) => {
                    this.loading = false;
                    this.category = res.data;
                    this.categoriables = res.data.categoriables.data;
                    this.pagination.currentPage = res.data.categoriables.current_page;
                    this.pagination.totalPage = res.data.categoriables.last_page;
                })
                .catch((err) => {
                    this.loading = false;
                    console.log(err);
                })
        },
        onPageChange() {
            this.getCategory();
            window.scrollTo(0, 0);
        }
    },
    mounted() {
        this.getCategory();
    }
};
</script>

<style scoped>
</style>

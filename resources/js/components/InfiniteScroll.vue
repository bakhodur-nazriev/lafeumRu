<template>
    <div>
        <v-list>
            <v-list-item v-for="(item, index) in items" :key="index"></v-list-item>
        </v-list>
        <div v-infinite-scroll="loadMore">
            <v-progress-circular v-if="loading" indeterminate color="primary"></v-progress-circular>
        </div>
    </div>
</template>

<script>
export default {
    props: ['url'],
    data() {
        return {
            page: 1,
            items: [],
            loading: false
        }
    },

    computed: {
        nextPage() {
            return this.page + 1;
        }
    },

    methods: {
        loadMore() {
            if (this.loading) return;
            this.loading = true;

            axios
                .get(this.url)
                .then((res) => {
                    this.items = [...this.items, ...res.data.data];
                    this.page = res.data.current_page;
                    this.loading = false;
                })
                .catch((err) => {
                    console.log(err);
                    this.loading = false;
                })
        }
    }
}
</script>
<template>
    <v-col xl="5">
        <h5 class="text-uppercase font-weight-regular py-4">Автор</h5>
        <div class="d-flex mb-5">
            <v-avatar class="mr-7 mb-7" size="100" v-if="current.photo">
                <img :src="current.photo"/>
            </v-avatar>
            <div>
                <h3 class="blue--text">{{ current.name }}</h3>
                <h5 class="author-biography" v-html="current.biography"></h5>
            </div>
        </div>

        <div v-for="(quote ,i) in current.quotes.data" :key="i">
            <quote-item :quote="quote"></quote-item>
        </div>

        <v-col cols="12">
            <v-pagination
                v-model="current.quotes.current_page"
                :length="current.quotes.last_page"
                :total-visible="7"
                @input="onPageChange"
            ></v-pagination>
        </v-col>
    </v-col>
</template>

<script>
import QuoteItem from "../layouts/QuoteItem";

export default {
    name: "Author",
    components: {QuoteItem},
    props: ["current", "authors"],
    data() {
        return {
            loading: false,
            pagination: {
                current: 1,
                total: 0
            }
        }
    },
    methods: {
        onPageChange() {

        }
    },
    created() {
        console.log(this.current.quotes);
    }
};
</script>

<style scoped>
.author-biography {
    font-weight: 400;
    font-size: 16px;
    line-height: 22px;
}
</style>

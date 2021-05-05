<template>
    <v-col xl="5">
        <div class="d-flex mb-5 mt-3">
            <v-avatar class="mr-7 mb-7" size="100" v-if="current.photo">
                <img :src="current.photo"/>
            </v-avatar>
            <div>
                <h3 class="blue--text">{{ current.name }}</h3>
                <h5 class="author-biography" v-html="current.biography"></h5>
            </div>
        </div>


        <quote-item
            v-for="(quote ,i) in current.quotes.data"
            :key="i"
            :quote="quote"
        >
        </quote-item>

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
    props: ["current", "authorListTitle", "authors"],
    data() {
        return {
            title: this.authorListTitle,
            loading: false,
            pagination: {
                current: 1,
                total: 0
            }
        }
    },
    created() {
        console.log(this.current);
    },
    methods: {
        onPageChange() {

        }
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

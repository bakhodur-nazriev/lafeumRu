<template>
    <v-col cols="5">
        <h5 class="text-uppercase font-weight-regular py-4">Автор</h5>
        <div class="d-flex">
            <v-avatar class="mr-7 mb-7" size="100" v-if="currentAuthor.photo">
                <img :src="currentAuthor.photo"/>
            </v-avatar>
            <div>
                <h3 class="blue--text">{{ currentAuthor.name }}</h3>
                <h5 class="author-biography" v-html="currentAuthor.biography"></h5>
            </div>
        </div>

        <div v-for="(authorsQuote, i) in currentAuthor.quotes" :key="i">
            <quote-item :authors-quote="authorsQuote"></quote-item>
        </div>

    </v-col>
</template>

<script>
import QuoteItem from "../layouts/QuoteItem";

export default {
    name: "Author",
    components: {QuoteItem},
    props: ["author"],

    data() {
        return {
            currentAuthor: this.author
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

<template>
    <v-col cols="5">
        <h5 class="text-uppercase font-weight-regular py-4 mx-4">Цитаты</h5>
        <quote-item :all-quoets="allQuotes"></quote-item>
    </v-col>
</template>

<script>
import QuoteItem from "./layouts/QuoteItem";

export default {
    components: {QuoteItem},
    props: ["quotes"],
    data() {
        return {
            allQuotes: this.quotes
        };
    }
};
</script>

<style scoped>
.categories-block a:hover {
    color: #04718C !important;
}
</style>

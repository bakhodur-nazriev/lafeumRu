<template>
    <v-col cols="5">
        <h5 class="text-uppercase font-weight-regular py-4 mx-4">Автор</h5>
<!--        <div class="d-flex">-->
<!--            <v-avatar size="100">-->
<!--                <img-->
<!--                    :src="currentAuthor.photo"-->
<!--                    alt="John"-->
<!--                >-->
<!--            </v-avatar>-->
<!--            <div>-->
<!--                <h3 class="blue&#45;&#45;text">{{ currentAuthor.name }}</h3>-->
<!--                <p>{{ currentAuthor.biography }}</p>-->
<!--            </div>-->
<!--        </div>-->

<!--        <quote-item></quote-item>-->
        <h1>kjasdnvkjndc</h1>
    </v-col>
</template>

<script>
import QuoteItem from "../layouts/QuoteItem";

export default {
    name: "Author",
    components: { QuoteItem },
    props: ["author"],

    data() {
        return {
            currentAuthor: this.author
        }
    }
}
</script>

<style scoped>

</style>

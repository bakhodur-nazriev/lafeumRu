<template>
    <!--    <v-card-->
    <!--        flat-->
    <!--        rounded="lg"-->
    <!--        class="mb-8"-->
    <!--        v-for="(quote , i) in lol.data"-->
    <!--        :key="i"-->
    <!--    >-->
    <!--        <v-card-subtitle class="d-flex px-6 py-4">-->
    <!--            <v-spacer></v-spacer>-->
    <!--            <a-->
    <!--                class="grey&#45;&#45;text text-decoration-none"-->
    <!--                :href="quote.post.id"-->
    <!--            >-->
    <!--                #{{ quote.post.id }}-->
    <!--            </a>-->
    <!--        </v-card-subtitle>-->

    <!--        <v-divider class="m-0 grey lighten-3"></v-divider>-->

    <!--        <v-card-text class="px-6 py-3">-->
    <!--            <p class="subtitle-1">{{ quote.body }}</p>-->
    <!--            <div class="mb-2">-->
    <!--                <a class="d-flex align-items-center text-decoration-none" :href="`/authors/` + quote.author.slug">-->
    <!--                    <v-icon color="grey lighten-1">mdi-account</v-icon>-->
    <!--                    <h5 class="mb-0 ml-1 black&#45;&#45;text subtitle-1">{{ quote.author.name }}</h5>-->
    <!--                </a>-->
    <!--            </div>-->
    <!--            <div class="categories-block">-->
    <!--                <a-->
    <!--                    class="mx-1 grey&#45;&#45;text text-decoration-none"-->
    <!--                    href=""-->
    <!--                    v-for="(category, i) in quote.categories"-->
    <!--                    :key="i"-->
    <!--                >-->
    <!--                    {{ category.name }}-->
    <!--                </a>-->
    <!--            </div>-->
    <!--        </v-card-text>-->
    <!--        <v-divider class="m-0 grey lighten-3"></v-divider>-->
    <!--        <v-card-actions class="px-4 py-3">-->
    <!--            <div v-for="(quoteAction ,i) in quoteActions" :key="i">-->
    <!--                <v-btn icon>-->
    <!--                    <v-icon color="grey lighten-1">{{ quoteAction.icon }}</v-icon>-->
    <!--                </v-btn>-->
    <!--                <span>{{ quoteAction.count }}</span>-->
    <!--            </div>-->
    <!--            <v-spacer></v-spacer>-->
    <!--            <div>-->
    <!--                <v-btn icon color="grey lighten-1">-->
    <!--                    <v-icon>mdi-share-variant</v-icon>-->
    <!--                </v-btn>-->
    <!--            </div>-->
    <!--        </v-card-actions>-->
    <!--    </v-card>-->
</template>

<script>
export default {
    data() {
        return {}
    }
}
</script>

<style scoped>

</style>

<template>
    <v-card
        flat
        rounded="lg"
        class="mb-8"
    >
        <v-card-subtitle class="d-flex px-6 py-4">
            <v-spacer></v-spacer>
            <a
                class="grey--text text-decoration-none"
                :href="quote.post.id"
            >
                #{{ quote.post.id }}
            </a>
        </v-card-subtitle>

        <v-divider class="m-0 grey lighten-3"></v-divider>

        <v-card-text class="px-6 py-3">
            <p class="subtitle-1">{{ quote.body }}</p>
            <div class="mb-2">
                <a class="d-flex align-items-center text-decoration-none"
                   :href="`/authors/` + quote.author.slug">
                    <v-icon color="grey lighten-1">mdi-account</v-icon>
                    <h5 class="mb-0 ml-1 black--text subtitle-1">{{ quote.author.name }}</h5>
                </a>
            </div>
            <div class="categories-block">
                <a
                    class="mx-1 grey--text text-decoration-none"
                    v-for="(category, i) in quote.categories"
                    :key="i"
                    :href="`/quotes/` + category.slug"
                >
                    {{ category.name }}
                </a>
            </div>
        </v-card-text>
        <v-divider class="m-0 grey lighten-3"></v-divider>
        <v-card-actions class="px-4 py-3">
            <div>
                <v-btn icon>
                    <v-icon color="grey lighten-1">
                        mdi-heart
                    </v-icon>
                </v-btn>
                <span>45</span>
                <v-btn icon>
                    <v-icon color="grey lighten-1">
                        mdi-bookmark
                    </v-icon>
                </v-btn>
                <span>45</span>
            </div>
            <v-spacer></v-spacer>

            <div class="d-flex align-items-center">
                <!--                <Vkontakte :url="baseUrl + quote.post.id" class="share-button&#45;&#45;circle" btnText/>-->
                <!--                <Facebook :url="baseUrl + quote.post.id" class="share-button&#45;&#45;circle" btnText/>-->
                <!--                <Odnoklassniki :url="baseUrl + quote.post.id" class="share-button&#45;&#45;circle" btnText/>-->
                <!--                <Twitter :url="baseUrl + quote.post.id" class="share-button&#45;&#45;circle" btnText/>-->
                <!--                <viber :url="baseUrl + quote.post.id" class="share-button&#45;&#45;circle" btnText/>-->
                <!--                <WhatsApp :url="baseUrl + quote.post.id" class="share-button&#45;&#45;circle" btnText/>-->
                <!--                <Telegram :url="baseUrl + quote.post.id" class="share-button&#45;&#45;circle" btnText/>-->
                <v-btn icon color="grey lighten-1">
                    <v-icon>mdi-share-variant</v-icon>
                </v-btn>
            </div>
        </v-card-actions>
    </v-card>
</template>

<script>
// import Vkontakte from "vue-share-buttons/src/components/VkontakteButton"
// import Facebook from "vue-share-buttons/src/components/FacebookButton"
// import Odnoklassniki from "vue-share-buttons/src/components/OdnoklassnikiButton"
// import Twitter from "vue-share-buttons/src/components/TwitterButton"
// import Viber from "vue-share-buttons/src/components/ViberButton"
// import WhatsApp from "vue-share-buttons/src/components/WhatsAppButton"
// import Telegram from "vue-share-buttons/src/components/TelegramButton"

export default {
    props: ["quote"],
    components: {
        // Vkontakte,
        // Facebook,
        // Odnoklassniki,
        // Twitter,
        // Viber,
        // WhatsApp,
        // Telegram
    },
    data() {
        return {
            test: this.quote,
            baseUrl: "http://127.0.0.1:8000/"
        }
    },
    created() {
        console.log(this.quote);
    }
}
</script>

<style scoped>

</style>

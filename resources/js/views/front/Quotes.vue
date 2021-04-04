<template>
    <v-col cols="5">
        <h5 class="text-uppercase font-weight-regular py-4 mx-4">Цитаты</h5>
        <v-card
            rounded="lg"
            class="mb-8"
            v-for="(quote , i) in quotes.data"
            :key="i"
        >
            <v-card-subtitle class="d-flex px-6 py-5">
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
                    <a class="d-flex align-items-center text-decoration-none" :href="`/authors/` + quote.author.slug">
                        <v-icon color="grey lighten-1">mdi-account</v-icon>
                        <h5 class="mb-0 ml-1 black--text subtitle-1">{{ quote.author.name }}</h5>
                    </a>
                </div>
                <div class="categories-block">
                    <a
                        class="mx-1 grey--text text-decoration-none"
                        href=""
                        v-for="(category, i) in quote.categories"
                        :key="i"
                    >
                        {{ category.name }}
                    </a>
                </div>
            </v-card-text>
            <v-divider class="m-0 grey lighten-3"></v-divider>
            <v-card-actions class="px-4 py-3">
                <div v-for="(quoteAction ,i) in quoteActions" :key="i">
                    <v-btn icon>
                        <v-icon color="grey lighten-1">{{ quoteAction.icon }}</v-icon>
                    </v-btn>
                    <span>{{ quoteAction.count }}</span>
                </div>
                <v-spacer></v-spacer>
                <div>
                    <!--                    <v-btn icon color="grey lighten-1">-->
                    <!--                        <v-icon>mdi-share-variant</v-icon>-->
                    <!--                    </v-btn>-->
                    <Vkontakte :url="quote.post.id" class="share-button--circle share-button--outline" btnText/>
                    <Facebook :url="quote.post.id" class="share-button--circle share-button--outline" btnText/>
                    <Odnoklassniki :url="quote.post.id" class="share-button--circle share-button--outline" btnText/>
                    <Twitter :url="quote.post.id" class="share-button--circle share-button--outline" btnText/>
                    <viber :url="quote.post.id" class="share-button--circle share-button--outline" btnText/>
                    <WhatsApp :url="quote.post.id" class="share-button--circle share-button--outline" btnText/>
                    <Telegram :url="quote.post.id" class="share-button--circle share-button--outline" btnText/>

                </div>
            </v-card-actions>

            <v-divider class="m-0 grey lighten-3"></v-divider>

            <v-card-text class="d-flex align-items-center px-6 py-5">
                <v-avatar size="50">
                    <img src="https://cdn.vuetifyjs.com/images/john.jpg">
                </v-avatar>
                <!--<v-text-field-->
                <!--dense-->
                <!--filled-->
                <!--rounded-->
                <!--clearable-->
                <!--class="rounded-lg ml-5"-->
                <!--label="Напишите комментарий..."-->
                <!-- > -->
                <!--</v-text-field>-->
            </v-card-text>
        </v-card>
        <v-col cols="12">
            <v-pagination
                v-model="pagination.current"
                :length="pagination.total"
                :total-visible="7"
                @input="onPageChange"
            ></v-pagination>
        </v-col>
    </v-col>
</template>

<script>
import Vkontakte from "vue-share-buttons/src/components/VkontakteButton"
import Facebook from "vue-share-buttons/src/components/FacebookButton"
import Odnoklassniki from "vue-share-buttons/src/components/OdnoklassnikiButton"
import Twitter from "vue-share-buttons/src/components/TwitterButton"
import Viber from "vue-share-buttons/src/components/ViberButton"
import WhatsApp from "vue-share-buttons/src/components/WhatsAppButton"
import Telegram from "vue-share-buttons/src/components/TelegramButton"

export default {
    components: {
        Vkontakte,
        Facebook,
        Odnoklassniki,
        Twitter,
        Viber,
        WhatsApp,
        Telegram
    },
    data() {
        return {
            quotes: {},
            loading: false,
            pagination: {
                current: 1,
                total: 0
            },
            quoteActions: [
                {
                    icon: "mdi-heart",
                    count: 45
                },
                {
                    icon: "mdi-bookmark",
                    count: 87
                },
                {
                    icon: "mdi-message-reply-text",
                    count: 52
                }
            ],
        };
    },
    methods: {
        getQuotes() {
            this.loading = true;
            axios
                .get("/api/quotes?page=" + this.pagination.current)
                .then(res => {
                    this.loading = false;
                    this.quotes = res.data.quotes;
                    this.pagination.current = res.data.quotes.current_page;
                    this.pagination.total = res.data.quotes.last_page;
                    // console.log(res.data);
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err)
                })
        },
        onPageChange() {
            this.getQuotes();
        }
    },
    mounted() {
        this.getQuotes();
    }
};
</script>

<style scoped>
.categories-block a:hover {
    color: #04718C !important;
}
</style>

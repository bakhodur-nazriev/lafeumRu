<template>
    <v-card flat rounded="lg" class="mb-6">
        <v-card-subtitle class="d-flex px-2 py-1 align-center">
            <a
                class="author-show-link primary--text"
                :href="'/authors/' + item.author.slug"
                target="_blank"
            >
                <v-icon color="grey dark" size="26">mdi-account</v-icon>
                <span class="ml-1">{{ item.author.name }}</span>
            </a>
            <v-spacer></v-spacer>
            <a
                class="quote-id grey--text text-decoration-none"
                :href="'/' + item.post.id"
                target="_blank"
            >
                #{{ item.post.id }}
            </a>
        </v-card-subtitle>

        <v-divider class="m-0 grey lighten-3"></v-divider>

        <v-card-text class="px-3 py-2">
            <v-col class="pa-0 quote-body">
                <p
                    class="font-italic grey--text text--darken-3 d-flex caption mb-2"
                    v-if="item.authors_thoughts"
                >
                    <span v-html="item.authors_thoughts"></span>
                </p>
                <vue-read-more-smooth :lines="15">
                    <span class="font-weight-regular quote-body" v-html="item.body"></span>
                    <template v-slot:more="value">
                        <div class="button-read-more">
                            {{ value.open ? "Скрыть" : "Читать далее..." }}
                        </div>
                    </template>
                </vue-read-more-smooth>
            </v-col>
            <v-col class="categories-block pa-0">
                <a
                    class="mr-2 font-italic"
                    v-for="(category, i) in item.categories"
                    :key="i"
                    :href="'/quotes/' + category.slug"
                    target="_blank"
                >
                    {{ category.name }}
                </a>
            </v-col>
        </v-card-text>
        <v-divider class="m-0 grey lighten-3"></v-divider>
        <v-card-actions class="pa-0 px-1">
            <div>
                <v-btn icon>
                    <v-icon color="grey lighten-1">mdi-heart</v-icon>
                </v-btn>
                <span>45</span>

                <v-btn v-if="!isFavorite" @click="favorite()" icon>
                    <v-icon color="grey lighten-1">mdi-bookmark</v-icon>
                </v-btn>

                <v-btn v-if="isFavorite" @click="unFavorite()" icon>
                    <v-icon color="primary lighten-1">mdi-bookmark</v-icon>
                </v-btn>
                {{ isFavorite }}
            </div>
            <v-spacer></v-spacer>
            <share-button :post="item.post"></share-button>
        </v-card-actions>
    </v-card>
</template>

<script>
import ShareButton from "../../../components/ShareButton";
import VueReadMoreSmooth from "vue-read-more-smooth";

export default {
    props: ["quote"],
    components: {ShareButton, VueReadMoreSmooth},
    data() {
        return {
            csrf: window.Laravel.csrf_token,
            item: this.quote,
            isActive: true,
            isFavorite: !!this.quote.favorites.length,
            user: window.Laravel.auth,
        };
    },
    methods: {
        readMore() {
            this.isActive = !this.isActive;
        },
        favorite() {
            if (!this.user) {
                window.location.href = '/login';
            } else {
                axios
                    .post('/api/quotes/' + this.item.id + '/favorites')
                    .then(res => {
                        console.log(res);
                        if (res.status === 200) {
                            this.isFavorite = true;
                        }
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        unFavorite() {
            if (!this.user) {
                window.location.href = '/login';
            } else {
                axios
                    .post('/api/quotes/' + this.item.id + '/unfavorites')
                    .then(res => {
                        console.log(res);
                        if (res.status === 200) {
                            this.isFavorite = true;
                        }
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }

        }
    },
    watch: {
        isFavorite(newVal, oldVal) {
            console.log('Old value:', oldVal);
            console.log('New value:', newVal);
        }
    },
};
</script>

<style scoped>
.quote-id:hover {
    color: #04718c !important;
}

.categories-block > a {
    text-decoration: none;
    color: #646464 !important;
    caret-color: #646464 !important;
    font-size: 13px;
}

.button-read-more {
    display: flex;
    justify-content: flex-end;
    font-size: 12px;
    font-style: italic;
    cursor: pointer;
    color: #646464 !important;
    padding-right: 5px;
}

.categories-block > a:hover {
    color: #04718c !important;
}

.quote-body {
    line-height: 1.5;
    font-size: 14px !important;
    color: #000;
}

.author-show-link {
    display: flex;
    align-items: center;
    width: fit-content;
    font-weight: 500;
}

.author-show-link:hover {
    text-decoration: none;
}
</style>

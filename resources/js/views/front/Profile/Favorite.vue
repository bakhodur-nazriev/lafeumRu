<template>
    <div class="pa-3 main-block">
        <v-card tile width="800" elevation="0" class="mx-auto rounded-lg pa-3">
            <TabNav :tabs="['Цитаты', 'Термины', 'Видео']" :selected="selected" @selected="setSelected">
                <Tab :is-selected="selected === 'Цитаты'">
                    <quote-item v-for="(quote, i) in quotes" :quote="quote" :key="i"></quote-item>
                </Tab>

                <Tab :is-selected="selected === 'Термины'">
                    <term-item v-for="(term, i) in terms" :term="term" :key="i"></term-item>
                </Tab>

                <Tab :is-selected="selected === 'Видео'">
                    <video-item v-for="(video, i) in videos" :video="video" :key="i"></video-item>
                </Tab>
            </TabNav>

        </v-card>
    </div>
</template>

<script>
import Tab from "./Tab";
import TabNav from "./TabNav";
import QuoteItem from "../layouts/QuoteItem";
import TermItem from "../layouts/TermItem";
import VideoItem from "../layouts/VideoItem";
import VueReadMoreSmooth from "vue-read-more-smooth";

export default {
    name: "Favourite",
    components: {
        Tab,
        TabNav,
        QuoteItem,
        TermItem,
        VideoItem,
        VueReadMoreSmooth
    },
    data() {
        return {
            selected: 'Цитаты',
            activeLink: false,
            quotes: [],
            terms: [],
            videos: [],
            user: window.Laravel.auth
        }
    },
    methods: {
        getFavorites() {
            axios
                .get("/api/users/" + this.user.id)
                .then(res => {

                    res.data.favorites_posts.forEach(el => {
                        console.log(el);
                        // if (el.favorited_type === 'Ap\\Quote') {
                            // this.quotes = el.quotes;
                        // }

                        // if (el.favorited_type === 'Ap\\Term') {
                            this.terms = el.terms;
                        // }

                        // if (el.favorited_type === 'Ap\\Video') {
                        //     this.videos = el;
                        // }
                    });

                    // console.log(this.quotes);
                })
                .catch(err => {
                    console.log(err);
                })
        },
        setSelected(tab) {
            this.selected = tab;
        },
    },
    mounted() {
        this.getFavorites();
    }

}
</script>

<style scoped>
.quote-id:hover {
    color: #04718c !important;
}

.categories-block>a {
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

.categories-block>a:hover {
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

@media (max-width: 767px) {
    .main-block {
        max-width: 100%;
    }
}
</style>

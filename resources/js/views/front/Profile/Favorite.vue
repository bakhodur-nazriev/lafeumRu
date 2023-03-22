<template>
    <div class="pa-3 main-block">
        <v-card
            tile
            width="800"
            elevation="0"
            class="mx-auto rounded-lg pa-3"
        >
            <TabNav
                :tabs="['Цитаты','Термины','Видео']"
                :selected="selected"
                @selected="setSelected"
            >
                <Tab :is-selected="selected === 'Цитаты'">
                    <quote-item
                        v-for="(quote, i) in quotes"
                        :quote="quote"
                        :key="i"
                    ></quote-item>
                </Tab>

                <Tab :is-selected="selected === 'Термины'">
                    <v-card
                        rounded="lg"
                        class="mb-6"
                        ref="termItem"
                        v-for="i in 3"
                        :key="i"
                    >
                        <v-card-subtitle class="d-flex align-items-center px-3 py-2">
                            <div class="d-flex">
                                <v-img
                                    v-for="icon in 3"
                                    :key="icon"
                                    width="18"
                                    height="18"
                                    src="/img/icons/atom.svg"
                                >
                                </v-img>
                            </div>
                            <v-spacer></v-spacer>
                            <a
                                class="term-id grey--text text-decoration-none"
                                href="#"
                                target="_blank"
                            >
                                #4321
                            </a>
                        </v-card-subtitle>

                        <v-divider class="ma-0 grey lighten-3"></v-divider>

                        <v-card-text
                            class="d-block main-content-body px-4 py-1 black--text"
                            ref="termItem"
                        >
                            <v-col
                                class="subtitle-2 pa-0 font-weight-light"
                                ref="termBody"
                            >
                                <vue-read-more-smooth :lines="15">
                                        <span class="font-weight-regular quote-body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium aliquid dicta dolor dolore doloribus dolorum ducimus et eum exercitationem, expedita ipsum iure laboriosam laudantium nam natus neque nisi nobis odio qui recusandae rem repellat sapiente sunt tempora, ut voluptas. Ad aut dolore illo nobis optio? Error ipsam reprehenderit ullam.
                                        </span>
                                    <template v-slot:more="value">
                                        <div class="button-read-more">
                                            {{ value.open ? "Скрыть" : "Читать далее..." }}
                                        </div>
                                    </template>
                                </vue-read-more-smooth>
                            </v-col>
                            <v-col class="categories-block my-2 pa-0">
                                <a class="mr-2 font-italic" href="#" target="_blank">
                                    Достижения и Твёрдость
                                </a>
                                <a class="mr-2 font-italic" href="#" target="_blank">
                                    Здоровый образ жизни
                                </a>
                                <a class="mr-2 font-italic" href="#" target="_blank">
                                    Компетентность
                                </a>
                            </v-col>
                        </v-card-text>
                        <v-divider class="m-0 grey lighten-3"></v-divider>
                        <v-card-actions class="px-2 py-0">
                            <div>
                                <v-btn icon>
                                    <v-icon color="grey lighten-1">mdi-heart</v-icon>
                                </v-btn>
                                <span>45</span>
                                <v-btn icon>
                                    <v-icon color="grey lighten-1">mdi-bookmark</v-icon>
                                </v-btn>
                            </div>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </Tab>

                <Tab :is-selected="selected === 'Видео'">
                    <p>Video content</p>
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
                .get("/api/users/")
                .then(res => {
                    console.log(res.data);
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

    // We will take all posts and compare with userFavorited
}
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

@media (max-width: 767px) {
    .main-block {
        max-width: 100%;
    }
}
</style>

<template>
    <v-card
        flat
        rounded="lg"
        class="mb-6"
        ref="termItem"
    >
        <v-card-subtitle class="d-flex align-items-center px-3 py-2">
            <div class="d-flex" v-if="item.term_type.name === `Термины научного мира`">
                <v-img
                    v-for="icon in 3"
                    :key="icon"
                    width="18"
                    height="18"
                    src="/img/icons/atom.svg"
                >
                </v-img>
            </div>
            <div v-else>
                <span>{{ item.term_type.name }}</span>
            </div>
            <v-spacer></v-spacer>
            <a
                class="term-id grey--text text-decoration-none"
                :href="'/' + item.post.id"
                target="_blank"
            >
                #{{ item.post.id }}
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
                    <span class="font-weight-regular quote-body" v-html="item.body"></span>
                    <template v-slot:more="value">
                        <div class="button-read-more">
                            {{ value.open ? "Скрыть" : "Читать далее..." }}
                        </div>
                    </template>
                </vue-read-more-smooth>
            </v-col>
            <v-card
                elevation="18"
                class="term-modal-card rounded-lg"
                v-show="showTermOfModal"
            >
                <v-card-text class="term-modal-card-text" v-html="termOfModal.extract_html"></v-card-text>
            </v-card>
            <v-col class="categories-block my-2 pa-0">
                <a
                    class="mr-2 font-italic"
                    v-for="(termCategories ,i) in item.categories"
                    :key="i"
                    :href="'/terms/' + termCategories.slug"
                    target="_blank"
                >
                    {{ termCategories.name }}
                </a>
            </v-col>
        </v-card-text>
        <v-divider class="m-0 grey lighten-3"></v-divider>
        <v-card-actions class="px-2 py-0">
            <!--<div>
                            <v-btn icon>
                                <v-icon color="grey lighten-1">mdi-heart</v-icon>
                            </v-btn>
                            <span>45</span>
                            <v-btn icon>
                                <v-icon color="grey lighten-1">mdi-bookmark</v-icon>
                            </v-btn>
                            <span>45</span>
                        </div>-->
            <v-spacer></v-spacer>
            <share-button :post="item.post"></share-button>
        </v-card-actions>
    </v-card>
</template>

<script>
import ShareButton from "../../../components/ShareButton";
import VueReadMoreSmooth from "vue-read-more-smooth";

export default {
    props: ["term"],
    components: {ShareButton, VueReadMoreSmooth},
    name: "TermItem",
    data() {
        return {
            item: this.term,
            termOfModal: "",
            showTermOfModal: false,
        }
    },
    mounted() {
        let href = new RegExp('\\/(\\d+)');
        let links = Array
            .from(this.$refs.termBody.querySelectorAll('a'))
            .filter(el => href.test(el.getAttribute('href')));

        if (links.length) {
            links.forEach((link) => {
                if (link) {
                    link.onmouseenter = async (e) => {
                        let url = '/api/summary' + `${e.target.getAttribute('href').match(href)}`;
                        let res = await axios.get(url);
                        if (res) {
                            this.termOfModal = res.data;
                            this.showTermOfModal = true;
                        }
                    };
                    link.onmouseout = () => {
                        this.showTermOfModal = false;
                    };
                }
            })
        }
    },
}
</script>

<style scoped>
.term-id:hover {
    color: #04718c !important;
}

.categories-block > a {
    font-weight: 500;
    text-decoration: none;
    color: #646464 !important;
    caret-color: #646464 !important;
    font-size: 13px;
}

.categories-block > a:hover {
    color: #04718c !important;
}

.term-modal-card {
    position: absolute;
    left: 15px;
    right: 15px;
    z-index: 10;
    display: flex;
    justify-content: center;
    align-items: center;
}

.term-modal-card-text {
    font-weight: 500;
    overflow: hidden;
}

.main-content-body > {
    color: #000 !important;
}

.button-read-more {
    display: flex;
    justify-content: end;
    font-size: 12px;
    font-style: italic;
    cursor: pointer;
    color: #646464 !important;
    padding-right: 5px;
}
</style>

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
                class="grey--text darken-4 terms-slug"
                :href="'/' + item.post.id"
            >
                #{{ item.post.id }}
            </a>
        </v-card-subtitle>

        <v-divider class="ma-0 grey lighten-3"></v-divider>

        <v-card-text
            class="d-block main-content-body px-4 py-1"
            ref="termItem"
        >
            <v-col
                :class="{'truncate-to-fifteen-line': isActive}"
                class="subtitle-2 pa-0 text-justify mb-3"
                ref="termBody"
            >
                <span v-html="item.body"></span>
            </v-col>
            <v-row class="text-right button-read-more">
                <v-spacer></v-spacer>
                <v-col class="py-0" v-if="isActive == true">
                    <span
                        @click="toggleVocabulary()"
                        class="read-more-btn"
                    >
                        Читать далее...
                        <v-icon small color="grey">mdi-chevron-down</v-icon>
                    </span>
                </v-col>
                <v-col class="py-0" v-else>
                    <span
                        @click="toggleVocabulary()"
                        class="read-more-btn"
                    >
                        Скрыть
                        <v-icon small color="grey">mdi-chevron-up</v-icon>
                    </span>
                </v-col>
            </v-row>
            <v-card
                elevation="18"
                class="term-modal-card rounded-lg text-justify"
                v-show="showTermOfModal"
            >
                <v-card-text class="term-modal-card-text" v-html="termOfModal.extract_html"></v-card-text>
            </v-card>
            <v-col class="categories-block my-2 pa-0">
                <a
                    class="mr-2 grey--text darken-4 text-decoration-none"
                    v-for="(termCategories ,i) in item.categories"
                    :key="i"
                    :href="'terms/' + termCategories.slug"

                >
                    {{ termCategories.name }}
                </a>
            </v-col>
        </v-card-text>
        <v-divider class="m-0 grey lighten-3"></v-divider>
        <v-card-actions class="px-2 py-0">
            <!--            <div>
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

export default {
    props: ["term"],
    components: {ShareButton},
    name: "TermItem",
    data() {
        return {
            item: this.term,
            termOfModal: "",
            showTermOfModal: false,
            isActive: true,
        }
    },
    methods: {
        toggleVocabulary() {
            this.isActive = !this.isActive;
        }
    },
    mounted() {
        document.querySelectorAll('.main-content-body').forEach(el => {
            if (el.querySelector('.truncate-to-fifteen-line').textContent.replace(/\s/g, "").length <= 1140) {
                el.querySelector('.button-read-more').style.display = "none";
            } else {
                el.querySelector('.button-read-more').style.display = "block";
            }
        });

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
    }
}
</script>

<style scoped>
.read-more-btn {
    font-size: 13px;
    color: grey;
}

.read-more-btn:hover {
    color: #04718c;
    cursor: pointer;
}

.truncate-to-fifteen-line {
    padding: 0;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 15;
    -webkit-box-orient: vertical;
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

.categories-block > a {
    font-weight: 500;
}

.terms-slug:hover {
    text-decoration: none;
    color: #04718c !important;
}
</style>

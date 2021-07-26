<template>
    <v-card
        flat
        rounded="lg"
        class="mb-8"
        ref="termItem"
    >
        <v-card-subtitle class="d-flex px-5 pa-4">
            <div class="d-flex" v-if="item.term_type.name === `Термины научного мира`">
                <v-img
                    v-for="icon in 3"
                    :key="icon"
                    src="/img/icons/atom.svg"
                    width="20"
                    class="mr-1"
                >
                </v-img>
            </div>
            <div v-else>
                <span>{{ item.term_type.name }}</span>
            </div>

            <v-spacer></v-spacer>

            <a
                class="grey--text text-decoration-none"
                :href="'/' + item.post.id"
            >
                #{{ item.post.id }}
            </a>
        </v-card-subtitle>

        <v-divider class="m-0 grey lighten-3"></v-divider>

        <v-card-text class="px-6 py-4 d-block main-content-body" ref="termItem">
            <v-col
                :class="{'truncate-to-fifteen-line': isActive}"
                class="subtitle-1 pa-0"
                v-html="item.body" ref="termBody"
            ></v-col>
            <v-row class="text-right button-read-more">
                <v-spacer></v-spacer>
                <v-col>
                    <a
                        @click="toggleVocabulary()"
                        class="text-primary text-decoration-none"
                    >
                        Читать дальше...
                    </a>
                </v-col>
            </v-row>
            <v-card
                elevation="18"
                class="term-modal-card rounded-lg pa-4"
                v-show="showTermOfModal"
            >
                <v-card-text class="term-modal-card-text pa-0" v-html="termOfModal.extract_html"></v-card-text>
            </v-card>
            <v-col class="categories-block mt-2 pa-0">
                <a
                    class="mr-2 grey--text text-decoration-none"
                    v-for="(termCategories ,i) in item.categories"
                    :key="i"
                    :href="`/terms/` + termCategories.slug"

                >
                    {{ termCategories.name }}
                </a>
            </v-col>
        </v-card-text>
        <v-divider class="m-0 grey lighten-3"></v-divider>
        <v-card-actions class="px-4 py-2">
            <!--            <div>-->
            <!--                <v-btn icon>-->
            <!--                    <v-icon color="grey lighten-1">-->
            <!--                        mdi-heart-->
            <!--                    </v-icon>-->
            <!--                </v-btn>-->
            <!--                <span>45</span>-->
            <!--                <v-btn icon>-->
            <!--                    <v-icon color="grey lighten-1">-->
            <!--                        mdi-bookmark-->
            <!--                    </v-icon>-->
            <!--                </v-btn>-->
            <!--                <span>45</span>-->
            <!--            </div>-->
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
            if (el.textContent.length < 1170) {
                el.querySelector('.button-read-more').style.display = "none";
            }
        });

        let href = new RegExp('\\/(\\d+\\/)$');
        let links = Array
            .from(this.$refs.termBody.querySelectorAll('a'))
            .filter(el => href.test(el.getAttribute('href')));

        if (links.length) {
            links.forEach((link, index) => {
                if (link) {
                    link.onmouseover = async (e) => {
                        let url = '/api/summary' + `${e.target.getAttribute('href')}`;
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
.truncate-to-fifteen-line {
    padding: 0;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 15;
    -webkit-box-orient: vertical;
}

.term-modal-card-text {
    overflow: hidden;
    max-height: 29vh;
    font-size: 15px;
}

.term-modal-card {
    position: absolute;
    left: 25px;
    right: 25px;
    z-index: 10;
}
</style>

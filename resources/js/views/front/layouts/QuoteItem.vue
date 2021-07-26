<template>
    <v-card flat rounded="lg" class="mb-6">
        <v-card-subtitle class="d-flex px-6 py-3">
            <v-spacer></v-spacer>
            <a class="grey--text text-decoration-none" :href="'/' + item.post.id">
                #{{ item.post.id }}
            </a>
        </v-card-subtitle>

        <v-divider class="m-0 grey lighten-3"></v-divider>

        <v-card-text class="px-6 py-3 main-content-body">
            <v-col
                :class="{'truncate-to-fifteen-line': isActive}"
                class="subtitle-1 pa-0"
                v-html="item.body"
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
            <div class="my-2">
                <a
                    class="d-flex align-items-center text-decoration-none author-show-link"
                    :href="`/authors/` + item.author.slug"
                >
                    <v-icon color="grey lighten-1">mdi-account</v-icon>
                    <h5 class="mb-0 ml-1 subtitle-1">
                        {{ item.author.name }}
                    </h5>
                </a>
            </div>
            <div class="categories-block">
                <a
                    class="mr-2 grey--text text-decoration-none"
                    v-for="(category, i) in item.categories"
                    :key="i"
                    :href="'/quotes/' + category.slug"
                >
                    {{ category.name }}
                </a>
            </div>
        </v-card-text>
        <v-divider class="m-0 grey lighten-3"></v-divider>
        <v-card-actions class="px-4 py-2">
            <!--            <div>-->
            <!--                <v-btn icon>-->
            <!--                    <v-icon color="grey lighten-1"> mdi-heart</v-icon>-->
            <!--                </v-btn>-->
            <!--                <span>45</span>-->
            <!--                <v-btn icon>-->
            <!--                    <v-icon color="grey lighten-1"> mdi-bookmark</v-icon>-->
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
    props: ["quote"],
    components: {ShareButton},
    data() {
        return {
            item: this.quote,
            isActive: true
        };
    },
    created() {
        console.log(this.quote);
    },

    methods: {
        toggleVocabulary() {
            this.isActive = !this.isActive;
        }
    },
    mounted() {
        document.querySelectorAll('.main-content-body').forEach(el => {
            if (el.textContent.length < 1310) {
                el.querySelector('.button-read-more').style.display = "none";
            }
        })
    }
};
</script>

<style scoped>
.author-show-link {
    width: fit-content;
    color: #000;
}

.author-show-link:hover {
    color: #04718c;
}

.truncate-to-fifteen-line {
    padding: 0;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 15;
    -webkit-box-orient: vertical;
}
</style>

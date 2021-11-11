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
                class="grey--text quote-id"
                :href="'/' + item.post.id"
                target="_blank"
            >
                #{{ item.post.id }}
            </a>
        </v-card-subtitle>

        <v-divider class="m-0 grey lighten-3"></v-divider>

        <v-card-text class="px-3 py-2 main-quotes-body">
            <v-col
                :class="{'truncate-to-fifteen-line': isActive}"
                class="text-justify mb-1 pa-0 quote-body"
            >
                <span class="font-weight-regular quote-body" v-html="item.body"></span>
            </v-col>
            <v-row class="text-right button-read-more">
                <v-spacer></v-spacer>
                <v-col v-if="isActive == true">
                    <span
                        @click="toggleVocabulary()"
                        class="read-more-btn"
                    >
                        Читать дальше...
                        <v-icon small color="grey">mdi-chevron-down</v-icon>
                    </span>
                </v-col>
                <v-col v-else>
                    <span
                        @click="toggleVocabulary()"
                        class="read-more-btn"
                    >
                        Скрыть
                        <v-icon small color="grey">mdi-chevron-up</v-icon>
                    </span>
                </v-col>
            </v-row>
            <v-col class="categories-block pa-0">
                <a
                    class="mr-2 font-weight-light"
                    v-for="(category, i) in item.categories"
                    :key="i"
                    :href="'quotes/' + category.slug"
                    target="_blank"
                >
                    {{ category.name }}
                </a>
            </v-col>
        </v-card-text>
        <v-divider class="m-0 grey lighten-3"></v-divider>
        <v-card-actions style="padding: 2px 4px 3px 4px;">
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
    methods: {
        toggleVocabulary() {
            this.isActive = !this.isActive;
        }
    },
    mounted() {
        document.querySelectorAll('.main-quotes-body').forEach(el => {
            if (el.querySelector('.truncate-to-fifteen-line').textContent.replace(/\s/g, "").length <= 920) {
                el.querySelector('.button-read-more').style.display = "none";
            } else {
                el.querySelector('.button-read-more').style.display = "block";
            }
        });
    }
};
</script>

<style>
.quote-id {
    text-decoration: none !important;
}

.quote-id:hover {
    color: #04718c !important;
}

.categories-block > a {
    text-decoration: none;
    color: #424242 !important;
    caret-color: #424242 !important;
    font-size: 13px;
}

.categories-block > a:hover {
    color: #04718c !important;
}

.quote-body {
    line-height: 1.5;
    font-size: 14px !important;
    color: #000;
}

.read-more-btn {
    font-size: 13px;
    color: grey;
}

.read-more-btn:hover {
    color: #04718c;
    cursor: pointer;
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

.truncate-to-fifteen-line {
    padding: 0;
    line-height: 1.5;
    font-size: 14px !important;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 15;
    -webkit-box-orient: vertical;
}
</style>

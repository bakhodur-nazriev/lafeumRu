<template>
    <div class="mb-0">
        <div v-if="vocabularyLetters == '/api/front/vocabulary'">
            <h4 class="vocabulary-letter text-decoration-none mb-0 font-weight-bold">{{ item.group }}</h4>
            <div>
                <div :class="{'truncate-to-seventeen-line': isActive}">
                    <v-hover
                        v-slot="{ hover }"
                        v-for="(child ,i) in item.children"
                        :key="i"
                    >
                        <a
                            :href="'/' + child.id"
                            target="_blank"
                            class="vocabulary-words text-decoration-none d-block"
                        >
                            <span>{{ child.name }}</span>
                            <v-card
                                elevation="18"
                                class="vocabulary-body rounded-lg pa-3"
                                v-show="hover"
                            >
                                <div v-html="child.body" style="overflow: hidden; max-height: 175px;"></div>
                            </v-card>
                        </a>
                    </v-hover>
                </div>
                <div
                    v-if="item.children.length >= 17"
                    class="text-right mb-3"
                >
                    <v-btn
                        text
                        small
                        v-if="isActive === true"
                        @click="toggleVocabulary()"
                        class="pa-0 toggle-button"
                    >
                        <v-icon small>mdi-chevron-down</v-icon>
                    </v-btn>
                    <v-btn
                        text
                        small
                        v-else
                        @click="toggleVocabulary()"
                        class="pa-0 toggle-button"
                    >
                        <v-icon small>mdi-chevron-up</v-icon>
                    </v-btn>
                </div>
            </div>
        </div>

        <div v-else>
            <v-hover
                v-for="(child ,i) in item.children"
                :key="i"
                v-slot="{ hover }"
            >
                <a
                    :href="'/' + child.id"
                    target="_blank"
                    class="vocabulary-words text-decoration-none d-block"
                >
                    <span>{{ child.name }}</span>
                    <v-card
                        elevation="18"
                        class="vocabulary-body rounded-lg pa-3"
                        v-show="hover"
                    >
                        <div v-html="child.body" style="overflow: hidden; max-height: 175px;"></div>
                    </v-card>
                </a>
            </v-hover>
        </div>
    </div>

</template>

<script>
export default {
    name: "ListOfChildren",
    props: ["item"],
    data() {
        return {
            isActive: true,
            showTerm: false
        }
    },
    methods: {
        toggleVocabulary() {
            this.isActive = !this.isActive;
        }
    },
    computed: {
        vocabularyLetters() {
            return '/api/front' + window.location.pathname;
        }
    }
}
</script>

<style scoped>
.vocabulary-body {
    position: absolute;
    background-color: #fff;
    margin-top: 3px;
    z-index: 1000;
}

.toggle-button {
    min-width: 30px !important;
}

.toggle-button > span > i {
    font-size: 22px !important;
}

.truncate-to-seventeen-line {
    padding: 0;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 17;
    -webkit-box-orient: vertical;
}

.vocabulary-letter {
    color: #494949;
    font-size: 20px;
}

.vocabulary-words {
    color: #494949;
    width: fit-content;
}

.vocabulary-words:hover {
    color: #1a718c;
}
</style>

<template>
    <div>
        <v-row justify="center" class="px-0">
            <v-col
                v-for="(vocabulary, i) in terms"
                :key="i"
                class="fill-height col-md-6 col-12"
            >
                <v-card rounded="lg" class="px-7 py-5" flat>
                    <v-card-text
                        v-for="(term, i) in vocabulary"
                        :key="i"
                        class="pa-0"
                    >
                        <v-col class="subtitle-2 pa-0 font-weight-light">
                            <v-hover v-slot="{ hover }">
                                <a
                                    :href="'/'+ `${path === '/vocabulary' ? term.id : term.post.id}`"
                                    target="_blank"
                                    class="vocabulary-words text-decoration-none d-block"
                                >
                                    <span>{{ term.name }}</span>
                                    <v-card
                                        v-show="hover"
                                        elevation="18"
                                        class="vocabulary-body rounded-lg pa-3"
                                    >
                                        <div v-html="term.body" style="overflow: hidden; max-height: 195px;"></div>
                                    </v-card>
                                </a>
                            </v-hover>
                        </v-col>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    name: "allVocabulary",
    props: ["terms"],
    data() {
        return {path: window.location.pathname}
    },
}
</script>

<style scoped>
.vocabulary-body {
    position: absolute;
    background-color: #fff;
    margin-top: 3px;
    z-index: 1000;
}

.vocabulary-words {
    color: #494949;
    width: fit-content;
    font-weight: normal;
    text-overflow: ellipsis;
    overflow: hidden;
    max-width: 100%;
    min-height: 22px;
    white-space: nowrap;
}

.vocabulary-words:hover {
    color: #1a718c;
}

.toggle-button > i {
    color: #444444 !important;
}
</style>

<template>
    <div>
        <h1 class="vocabulary-letter text-decoration-none pt-4 pb-2">{{ term.group }}</h1>
        <div>
            <div :class="{'truncate-to-seven-line': isActive}">
                <a
                    v-for="(child ,i) in term.children"
                    :key="i"
                    class="vocabulary-words text-decoration-none d-block"
                    :href="child.post.id"
                    target="_blank">
                    {{ child.name }}
                </a>
                <br/>
            </div>
            <div v-if="term.children.length >= 17" class="text-right load-more-vocabulary">
                <v-btn
                    text
                    color="primary"
                    @click="toggleVocabulary()"
                    class="font-italic"
                >
                    еще.
                    <v-icon small>mdi-arrow-right</v-icon>
                </v-btn>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "VocabularyChildren",
    props: ["term"],
    data() {
        return {
            isActive: true
        }
    },
    methods: {
        toggleVocabulary() {
            this.isActive = !this.isActive;
        }
    }
}
</script>

<style scoped>
.v-btn {
    text-transform: lowercase;
}

.truncate-to-seven-line {
    padding: 0;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 17;
    -webkit-box-orient: vertical;
}

.vocabulary-letter {
    color: #494949;
}

.vocabulary-words {
    color: #494949;
}

.vocabulary-words:hover {
    color: #1a718c;
}
</style>

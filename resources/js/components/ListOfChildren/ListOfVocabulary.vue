<template>
    <div>
        <h1 class="vocabulary-letter text-decoration-none pt-4 pb-2">{{ item.group }}</h1>
        <div>
            <div :class="{'truncate-to-seventeen-line': isActive}">
                <a
                    v-for="(child ,i) in item.children"
                    :key="i"
                    class="vocabulary-words text-decoration-none d-block"
                    :href="child.post.id"
                    target="_blank">
                    {{ child.name }}
                </a>
                <br/>
            </div>
            <div v-if="item.children.length >= 17" class="text-right mt-4">
                <v-btn
                    text
                    small
                    @click="toggleVocabulary()"
                    class="pa-0 toggle-button"
                >
                    <v-icon small>mdi-chevron-right</v-icon>
                </v-btn>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "ListOfChildren",
    props: ["item"],
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
.toggle-button {
    min-width: 30px !important;
    border: 2px solid #494949;
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
}

.vocabulary-words {
    color: #494949;
    width: fit-content;
}

.vocabulary-words:hover {
    color: #1a718c;
}
</style>

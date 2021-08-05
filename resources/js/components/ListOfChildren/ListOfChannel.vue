<template>
    <v-col class="pa-0">
        <h1 class="vocabulary-letter text-decoration-none mb-0 pt-2">{{ item.group }}</h1>
        <v-col class="pa-0">
            <div :class="{'truncate-to-seventeen-line': isActive}">
                <a
                    v-for="(child ,i) in item.children"
                    class="vocabulary-words text-decoration-none d-block"
                    :key="i"
                    :href="'/channels/' + child.slug"
                    target="_blank"
                >
                    {{ child.name }}
                </a>
            </div>
            <div v-if="item.children.length >= 17 && isActive == true" class="text-left mt-4">
                <v-btn
                    text
                    small
                    class="pa-0 toggle-button"
                    @click="toggleChannel()"
                >
                    <v-icon small>mdi-chevron-down</v-icon>
                </v-btn>
            </div>
            <div v-if="isActive == false" class="text-left mt-4">
                <v-btn
                    text
                    small
                    class="pa-0 toggle-button"
                    @click="toggleChannel()"
                >
                    <v-icon small>mdi-chevron-up</v-icon>
                </v-btn>
            </div>
        </v-col>
    </v-col>
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
        toggleChannel() {
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

<template>
    <v-col class="pa-0">
        <h4 class="authors-letter text-decoration-none">{{ item.group }}</h4>
        <v-col class="pa-0">
            <div :class="{'truncate-to-seventeen-line': isActive}">
                <a
                    v-for="(child ,i) in item.children"
                    :key="i"
                    :href="'/authors/' + child.slug"
                    class="author-words text-decoration-none d-block fit"
                    target="_blank"
                >
                    {{ child.name }}
                </a>
            </div>
            <div v-if="item.children.length >= 17" class="text-right">
                <v-btn
                    text
                    small
                    v-if="isActive == true"
                    @click="toggleAuthor()"
                    class="pa-0 toggle-button"
                >
                    <v-icon small>mdi-chevron-down</v-icon>
                </v-btn>
                <v-btn
                    text
                    small
                    v-else
                    class="pa-0 toggle-button"
                    @click="toggleAuthor()"
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
        toggleAuthor() {
            this.isActive = !this.isActive;
        }
    }
}
</script>

<style scoped>
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

.author-words {
    color: #494949;
    width: fit-content;
}

.author-words:hover {
    color: #1a718c;
}

.authors-letter {
    color: #494949;
    font-size: 20px;
}
</style>

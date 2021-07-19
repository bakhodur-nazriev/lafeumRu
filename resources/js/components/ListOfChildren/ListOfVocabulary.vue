<template>
    <div class="mb-2">
        <h3 class="vocabulary-letter text-decoration-none mb-0">{{ item.group }}</h3>
        <div>
            <div :class="{'truncate-to-seventeen-line': isActive}">
                <v-hover
                    v-slot="{ hover }"
                    v-for="(child ,i) in item.children"
                    :key="i"
                >
                    <a
                        :href="'/' + child.post.id"
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
            isActive: true,
            showTerm: false
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
.vocabulary-body {
    position: absolute;
    background-color: #fff;
    margin-top: 3px;
    z-index: 1000;
}

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

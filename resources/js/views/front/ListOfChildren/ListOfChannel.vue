<template>
    <v-col class="pa-0">
        <a
            target="_blank"
            :href="'/channels/' + item.slug"
            class="vocabulary-words text-decoration-none d-block"
        >
            {{ item.name }}
        </a>
    </v-col>
</template>

<script>
export default {
    name: "ListOfChildren",
    props: ["item"],
    data() {
        return {}
    },
}
</script>

<style scoped>
.vocabulary-words {
    color: #494949;
    width: fit-content;
    text-overflow: ellipsis;
    overflow: hidden;
    max-width: 100%;
    min-height: 22px;
    white-space: nowrap;
}

.vocabulary-words:hover {
    color: #1a718c;
}
</style>

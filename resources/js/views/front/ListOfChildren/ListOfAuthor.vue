<template>
    <v-col class="pa-0">
        <a
            target="_blank"
            :href="'/authors/' + item.slug"
            class="author-words text-decoration-none d-block fit"
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
.author-words {
    color: #494949;
    width: fit-content;
    text-overflow: ellipsis;
    overflow: hidden;
    max-width: 100%;
    min-height: 22px;
    white-space: nowrap;
}

.author-words:hover {
    color: #1a718c;
}
</style>

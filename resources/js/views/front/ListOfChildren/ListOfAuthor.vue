<template>
    <v-col class="pa-0">
        <v-col class="pa-0">
            <div>
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
}
</script>

<style scoped>

</style>

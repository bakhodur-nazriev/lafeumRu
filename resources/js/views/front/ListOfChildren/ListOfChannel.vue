<template>
    <v-col class="pa-0">
        <v-col class="pa-0">
            <div>
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

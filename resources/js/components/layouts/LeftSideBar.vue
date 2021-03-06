<template>
    <v-col cols="2">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">темы</h5>
        <v-sheet class="pa-5" rounded="lg" width="100%" height="95%">
            <v-expansion-panels flat hover>
                <v-expansion-panel
                    v-for="(category, i) in categories"
                    :key="i"
                >
                    <v-expansion-panel-header ripple class="px-0" expand-icon="mdi-menu-down">
                        <v-icon>{{ category.icon }}</v-icon> 
                        {{ category.name }}
                    </v-expansion-panel-header>
                    <v-expansion-panel-content
                        v-for="(subCategory, i) in categories.children"
                        :key="i"
                    >

                        {{ subCategory.name }}
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-sheet>
    </v-col>
</template>

<script>
export default {
    name: "LeftSideBar",
    props: ["categories"],

    data() {
        return {
        
        }
    }
}
</script>

<style scoped>
button:focus{
    outline: none;
}
</style>

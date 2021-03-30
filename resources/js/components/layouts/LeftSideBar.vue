<template>
    <v-col cols="2">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">темы</h5>
        <v-sheet class="pa-5" rounded="lg" width="100%" height="95%">
            <v-expansion-panels
                flat
                multiple
                v-model="panel"
            >
                <v-expansion-panel
                    v-for="(category, i) in allCategories"
                    :key="i"
                >
                    <v-expansion-panel-header class="px-0">
                        {{ category.name }}
                    </v-expansion-panel-header>
                    <v-divider class="m-0"></v-divider>
<!--                    <v-expansion-panel-content>-->
<!--                        <v-btn-->
<!--                            class="text-capitalize px-0 font-weight-normal"-->
<!--                            v-for="(subCategory, i) in category.children"-->
<!--                            :key="i"-->
<!--                            href=""-->
<!--                            text-->
<!--                        >-->
<!--                            {{ subCategory.name }}-->
<!--                        </v-btn>-->
<!--                    </v-expansion-panel-content>-->
                    <v-col class="v-expansion-panel-content d-block">
                        <v-btn
                            class="text-capitalize px-0 font-weight-normal"
                            v-for="(subCategory, i) in category.children"
                            :key="i"
                            href=""
                            text
                        >
                            {{ subCategory.name }}
                        </v-btn>
                    </v-col>
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
            allCategories: this.categories,
            panel: [0]
        }
    },
    created() {
        for (const categ of this.allCategories) {
            console.log(categ.name);
            for (const subCat of categ.children) {
                console.log(" - " + subCat.name);
            }
        }
    }
}
</script>

<style scoped>
button:focus {
    outline: none;
}
</style>

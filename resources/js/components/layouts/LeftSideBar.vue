<template>
    <v-col cols="2">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">темы</h5>
        <v-sheet class="pa-2" rounded="lg" height="300" width="100%">
            <v-expansion-panels flat multiple>
                <!--                <v-expansion-panel-->
                <!--                    v-for="(category, i) in allCategories"-->
                <!--                    :key="i"-->
                <!--                >-->
                <!--                    <v-expansion-panel-header class="font-weight-medium">-->
                <!--                        <a href="">{{ category.label }}</a>-->
                <!--                    </v-expansion-panel-header>-->
                <!--                    <v-expansion-panel-content>-->
                <!--                        <div-->
                <!--                            v-for="(subCategory, i) in category.children"-->
                <!--                            :key="i"-->
                <!--                            class="py-1"-->
                <!--                        >-->
                <!--                            <a href="" class="sub-category-links">{{ subCategory.name }}</a>-->
                <!--                        </div>-->
                <!--                    </v-expansion-panel-content>-->
                <!--                </v-expansion-panel>-->
            </v-expansion-panels>
        </v-sheet>
    </v-col>
</template>

<script>
export default {
    name: "LeftSideBar",
    // props: ["categories"],
    data() {
        return {
            // allCategories: this.categories,
            // panel: [0, 1, 2]
        }
    }
}
</script>

<style scoped>
button:focus {
    outline: none;
}

.sub-category-links {
    color: #494949;
    text-decoration: none;
}

.sub-category-links:hover {
    color: #04718c;
}
</style>

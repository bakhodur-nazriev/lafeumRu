<template>
    <v-col cols="2">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">темы</h5>
        <v-sheet class="pa-2" rounded="lg" height="96%" width="100%">
            <v-expansion-panels flat>
                <v-expansion-panel>
                    <v-expansion-panel-header class="font-weight-bold">
                        {{ allCategories[0].name }}
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                        <div
                            v-for="(postLink ,i) in allCategories[0].post_links"
                            :key="i"
                            class="font-weight-normal"
                        >
                            <a :href="postLink.href">{{ postLink.label }}</a>
                        </div>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
            <v-expansion-panels flat>
                <v-expansion-panel
                    class="deep-expansion-panel"
                    v-for="(subCategory ,i) in allCategories[0].children"
                    :key="i"
                >
                    <v-expansion-panel-header expand-icon="">
                        {{ subCategory.name }}
                    </v-expansion-panel-header>
                    <v-expansion-panel-content
                        class="deep-expansion-panel-content pa-0"
                    >
                        <div
                            v-for="(subPostLink ,i) in subCategory.post_links"
                            :key="i"
                        >
                            <a :href="subPostLink.href">{{ subPostLink.label }}</a>
                        </div>
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
            allCategories: this.categories,
        }
    },
    created() {
        console.log(this.categories);
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

.v-expansion-panel > .deep-expansion-panel-header {
    padding: 0;
    min-height: 30px;
}

.v-expansion-panel-content__wrap {
    padding: 0 !important;
}


</style>

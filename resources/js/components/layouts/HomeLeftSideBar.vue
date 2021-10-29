<template>
    <v-col
        xl="2"
        lg="3"
        md="5"
        sm="6"
        class="fill-height col-12"
    >

        <v-col class="hidden-sm-and-up pa-0">
            <v-expansion-panels flat>
                <v-expansion-panel>
                    <v-expansion-panel-header class="small-title-expansion-header text-uppercase font-weight-medium">
                        Темы
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                        <div v-for="(category, i) in allCategories" :key="i">
                            <!-- Category -->
                            <v-expansion-panels flat>
                                <v-expansion-panel>
                                    <v-expansion-panel-header
                                        class="font-weight-bold small-expansion-header"
                                    >
                                        {{ category.name }}
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content ref="contentLinks" class="small-expansion-content">
                                        <v-col
                                            v-for="(postLink, i) in category.post_links"
                                            :key="i"
                                            class="font-weight-normal pa-0"
                                        >
                                            <a
                                                :href="postLink.href"
                                                class="text-decoration-none category-links"
                                            >
                                                {{ postLink.label }}
                                            </a>
                                        </v-col>
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                            </v-expansion-panels>

                            <!-- SubCategory -->
                            <v-expansion-panels flat>
                                <v-expansion-panel
                                    class="ma-0"
                                    v-for="(subCategory, i) in category.children"
                                    :key="i"
                                >
                                    <v-expansion-panel-header
                                        expand-icon=""
                                        class="deep-sub-expansion-panel-header small-sub-expansion-header"
                                    >
                                        {{ subCategory.name }}
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content class="small-sub-expansion-content">
                                        <div v-for="(subPostLink, i) in subCategory.post_links" :key="i">
                                            <a
                                                :href="subPostLink.href"
                                                class="text-decoration-none category-links"
                                            >
                                                {{ subPostLink.label }}
                                            </a>
                                        </div>
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                            </v-expansion-panels>
                        </div>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-col>

        <v-col class="fill-height hidden-xs-only pa-0">
            <h5 class="text-uppercase font-weight-normal py-4 mb-0">темы</h5>
            <v-sheet
                class="pa-2"
                rounded="lg"
            >
                <v-col
                    v-for="(category, i) in allCategories"
                    :key="i"
                    class="my-2 pa-0"
                >
                    <!-- Category -->
                    <v-expansion-panels flat>
                        <v-expansion-panel>
                            <v-expansion-panel-header
                                expand-icon=""
                                class="font-weight-bold big-expansion-header"
                            >
                                {{ category.name }}
                            </v-expansion-panel-header>
                            <v-expansion-panel-content ref="contentLinks" class="big-expansion-content">
                                <v-col
                                    v-for="(postLink, i) in category.post_links"
                                    :key="i"
                                    class="font-weight-normal pa-0"
                                >
                                    <a
                                        :href="postLink.href"
                                        class="text-decoration-none category-links"
                                    >
                                        {{ postLink.label }}
                                    </a>
                                </v-col>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>

                    <!-- SubCategory -->
                    <v-expansion-panels flat>
                        <v-expansion-panel
                            class="ma-0"
                            v-for="(subCategory, i) in category.children"
                            :key="i"
                        >
                            <v-expansion-panel-header
                                expand-icon=""
                                class="big-sub-expansion-header"
                            >
                                {{ subCategory.name }}
                            </v-expansion-panel-header>
                            <v-expansion-panel-content class="big-sub-expansion-content">
                                <v-col
                                    v-for="(subPostLink, i) in subCategory.post_links"
                                    :key="i"
                                    class="pa-0"
                                >
                                    <a
                                        :href="subPostLink.href"
                                        class="text-decoration-none category-links"
                                    >
                                        {{ subPostLink.label }}
                                    </a>
                                </v-col>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>
                </v-col>
            </v-sheet>
        </v-col>
    </v-col>
</template>

<script>

export default {
    name: "LeftSideBar",
    props: ["categories"],
    data() {
        return {
            allCategories: this.categories,
        };
    }
};
</script>

<style scoped>
button:focus {
    outline: none;
}

.category-links {
    color: #04718c;
    text-decoration: none;
    font-weight: normal;
}

.category-links:hover {
    color: #494949;
}

.small-title-expansion-header {
    padding: 16px 24px !important;
}

.v-expansion-panel--active + .v-expansion-panel, .v-expansion-panel--active:not(:first-child) {
    margin-top: 0;
}

.small-expansion-header,
.small-sub-expansion-header {
    padding: 0 !important;
    min-height: 25px !important;
}

.small-expansion-content >>> .v-expansion-panel-content__wrap,
.small-sub-expansion-content >>> .v-expansion-panel-content__wrap {
    padding: 0 !important;
}

.big-expansion-header,
.big-sub-expansion-header {
    padding: 0 14px;
    min-height: 25px;
}

.big-expansion-content >>> .v-expansion-panel-content__wrap,
.big-sub-expansion-content >>> .v-expansion-panel-content__wrap {
    padding: 0 14px;
}

</style>

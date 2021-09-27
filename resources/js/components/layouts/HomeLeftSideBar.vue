<template>
    <v-col
        xl="2"
        lg="3"
        md="3"
        class="left-home-main-block fill-height"
    >

        <v-col class="hidden-sm-and-up pa-0">
            <v-expansion-panels flat>
                <v-expansion-panel>
                    <v-expansion-panel-header
                        class="deep-small-expansion-panel-header"
                    >
                        Темы
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                        <div v-for="(category, i) in allCategories" :key="i">
                            <!-- Category -->
                            <v-expansion-panels flat>
                                <v-expansion-panel>
                                    <v-expansion-panel-header
                                        class="font-weight-bold deep-expansion-panel-header"
                                    >
                                        {{ category.name }}
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content ref="contentLinks">
                                        <div
                                            v-for="(postLink, i) in category.post_links"
                                            :key="i"
                                            class="font-weight-normal"
                                        >
                                            <a
                                                :href="postLink.href"
                                                class="text-decoration-none category-links"
                                            >
                                                {{ postLink.label }}
                                            </a>
                                        </div>
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                            </v-expansion-panels>

                            <!-- SubCategory -->
                            <v-expansion-panels flat>
                                <v-expansion-panel
                                    class="deep-expansion-panel"
                                    v-for="(subCategory, i) in category.children"
                                    :key="i"
                                >
                                    <v-expansion-panel-header
                                        expand-icon=""
                                        class="deep-sub-expansion-panel-header"
                                    >
                                        {{ subCategory.name }}
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content>
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
                <div
                    v-for="(category, i) in allCategories"
                    :key="i"
                    class="my-2"
                >
                    <!-- Category -->
                    <v-expansion-panels flat>
                        <v-expansion-panel>
                            <v-expansion-panel-header
                                expand-icon=""
                                class="font-weight-bold deep-expansion-panel-header"
                            >
                                {{ category.name }}
                            </v-expansion-panel-header>
                            <v-expansion-panel-content ref="contentLinks">
                                <div
                                    v-for="(postLink, i) in category.post_links"
                                    :key="i"
                                    class="font-weight-normal"
                                >
                                    <a
                                        :href="postLink.href"
                                        class="text-decoration-none category-links"
                                    >
                                        {{ postLink.label }}
                                    </a>
                                </div>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>

                    <!-- SubCategory -->
                    <v-expansion-panels flat>
                        <v-expansion-panel
                            class="deep-expansion-panel"
                            v-for="(subCategory, i) in category.children"
                            :key="i"
                        >
                            <v-expansion-panel-header
                                expand-icon=""
                                class="deep-sub-expansion-panel-header"
                            >
                                {{ subCategory.name }}
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
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

.deep-expansion-panel {
    margin: 0;
}

.v-expansion-panel-header {
    padding: 0 14px !important;
}

.v-expansion-panel--active > .v-expansion-panel-header {
    min-height: 30px;
}

.v-expansion-panel--active + .v-expansion-panel, .v-expansion-panel--active:not(:first-child) {
    margin-top: 0px;
}

.v-expansion-panel-header
.deep-sub-expansion-panel-header
.v-expansion-panel-header--active {
    min-height: 20px;
}

.deep-expansion-panel-header {
    min-height: 25px !important;
}

.deep-sub-expansion-panel-header {
    padding: 0 24px;
    min-height: 25px !important;
}

.deep-small-expansion-panel-header {
    padding: 16px 24px !important;
}

v-expansion-panel-content > .v-expansion-panel-content__wrap{
    padding: 0 !important;
}
</style>

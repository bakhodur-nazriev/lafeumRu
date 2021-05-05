<template>
    <v-col lg="3" xl="2">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">темы</h5>
        <v-sheet class="pa-2" rounded="lg" height="96%" width="100%">
            <div v-for="(c, i) in count" :key="i">
                <!-- Category -->
                <v-expansion-panels flat>
                    <v-expansion-panel>
                        <v-expansion-panel-header
                            class="font-weight-bold deep-expansion-panel-header"
                        >
                            {{ allCategories[c].name }}
                        </v-expansion-panel-header>
                        <v-expansion-panel-content>
                            <div
                                v-for="(postLink, i) in allCategories[c].post_links"
                                :key="i"
                                class="font-weight-normal"
                            >
                                <a :href="postLink.href" class="text-decoration-none">{{
                                    postLink.label
                                    }}</a>
                            </div>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-expansion-panels>

                <!-- SubCategory -->
                <v-expansion-panels flat>
                    <v-expansion-panel
                        class="deep-expansion-panel"
                        v-for="(subCategory, i) in allCategories[c].children"
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
                                    class="text-decoration-none"
                                >
                                    {{ subPostLink.label }}
                                </a>
                            </div>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-expansion-panels>
            </div>
        </v-sheet>
        <scroller></scroller>
    </v-col>
</template>

<script>
import Scroller from "../Scroller";

export default {
    name: "LeftSideBar",
    components: {Scroller},
    props: ["categories"],
    data() {
        return {
            allCategories: this.categories,
            count: [0, 1, 2, 3],
        };
    },
};
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

.deep-expansion-panel {
    margin: 0;
}

.v-expansion-panel--active > .v-expansion-panel-header {
    min-height: 30px;
}

.v-expansion-panel--active + .v-expansion-panel, .v-expansion-panel--active:not(:first-child) {
    margin-top: 0px;
}

.v-expansion-panel-header .deep-sub-expansion-panel-header .v-expansion-panel-header--active {
    min-height: 30px;
}

.deep-sub-expansion-panel-header {
    padding: 0 24px;
    min-height: 30px;
}

.deep-expansion-panel-header {
    min-height: 30px;
}
</style>

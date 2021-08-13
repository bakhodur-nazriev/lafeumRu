<template>
    <v-col xl="2" lg="3" md="2" class="pb-0 left-main-block pa-sm-0 col-12">

        <v-col class="hidden-sm-and-up pa-0">
            <v-expansion-panels flat>
                <v-expansion-panel>
                    <v-expansion-panel-header>
                        Темы
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                        <v-list-item
                            v-for="(category, i) in categories"
                            class="px-0"
                            :key="i"
                        >
                            <v-list-item-content two-line>
                                <v-list-item-title class="mb-3">
                                    <a
                                        :href="`${categoryType}` + category.slug"
                                        class="font-weight-bold category-links px-1"
                                    >
                                        {{ category.name }}
                                    </a>
                                </v-list-item-title>

                                <v-list-item-subtitle
                                    v-for="(subCategory, i) in category.children"
                                    :key="i"
                                    class="mb-3"
                                >
                                    <a
                                        :href="`${categoryType}` + subCategory.slug"
                                        class="category-links px-1"
                                    >
                                        {{ subCategory.name }}
                                    </a>
                                </v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-col>

        <v-col class=" fill-height hidden-xs-only">
            <h5 class="text-uppercase text-secondary font-weight-normal py-4">темы</h5>
            <v-sheet class="pa-2" rounded="lg">
                <!-- Category -->

                <v-list-item
                    v-for="(category, i) in categories"
                    class="px-1"
                    :key="i"
                >
                    <v-list-item-content two-line>
                        <v-list-item-title class="mb-3">
                            <a
                                class="font-weight-bold category-links"
                                :href="`${categoryType}` + category.slug"
                            >
                                {{ category.name }}
                            </a>
                        </v-list-item-title>

                        <v-list-item-subtitle
                            v-for="(subCategory, i) in category.children"
                            :key="i"
                            class="mb-3"
                        >
                            <a
                                :href="`${categoryType}` + subCategory.slug"
                                class="category-links"
                            >
                                {{ subCategory.name }}
                            </a>
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-sheet>
        </v-col>
    </v-col>
</template>

<script>
export default {
    name: 'LeftSideBar',
    props: ['categories'],
    data() {
        return {}
    },
    computed: {
        categoryType() {
            let linkPrefix = window.location.pathname;

            for (const category of this.categories) {
                if (linkPrefix.includes('/vocabulary')) {
                    return '/vocabulary/';
                } else if (category.type == 'App\\Quote') {
                    return '/quotes/';
                } else if (category.type == 'App\\Term') {
                    return '/terms/';
                } else if (category.type == 'App\\Video') {
                    return '/videos/';
                }
            }
        }
    }
};
</script>

<style scoped>
@media (min-width: 1264px) and (max-width: 1904px) {
    .left-main-block {
        max-width: 20%;
    }
}

@media (min-width: 1904px) {
    .left-main-block {
        max-width: 14.5%;
    }
}

button:focus {
    outline: none;
}

.category-links {
    color: #000;
    padding: 0 7px;
    font-size: 15px;
}

.category-links:hover {
    text-decoration: none;
    color: #04718c;
}
</style>

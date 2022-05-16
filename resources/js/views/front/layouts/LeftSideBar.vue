<template>
    <v-col
        xl="2"
        lg="3"
        md="5"
        sm="6"
        class="fill-height col-12"
        order="1"
    >
        <!-- For small display -->
        <v-col class="hidden-sm-and-up pa-0">
            <v-expansion-panels flat>
                <v-expansion-panel>
                    <v-expansion-panel-header class="text-uppercase font-weight-medium">
                        <span v-if="categoryType == '/quotes/'">цитаты по темам</span>
                        <span v-if="categoryType == '/terms/'">термины по темам</span>
                        <span v-if="categoryType == '/videos/'">видео по темам</span>
                        <span v-if="categoryType == '/vocabulary/'">словарь по темам</span>
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                        <v-list-item
                            v-for="(category, i) in categories"
                            :key="i"
                            class="px-0"
                        >
                            <v-list-item-content two-line class="pa-0">
                                <v-list-item-title class="mb-3">
                                    <a
                                        target="_blank"
                                        :href="`${categoryType}` + category.slug"
                                        class="title-links px-1"
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
                                        target="_blank"
                                        class="subtitle-links px-1"
                                        :href="`${categoryType}` + subCategory.slug"
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

        <!-- For Large display -->
        <v-col class="fill-height hidden-xs-only pa-0">
            <h5
                class="text-uppercase font-weight-normal py-4 mb-0"
                v-if="categoryType == '/quotes/'"
            >цитаты по темам</h5>
            <h5
                class="text-uppercase font-weight-normal py-4 mb-0"
                v-if="categoryType == '/terms/'"
            >термины по темам</h5>
            <h5
                class="text-uppercase font-weight-normal py-4 mb-0"
                v-if="categoryType == '/videos/'"
            >видео по темам</h5>
            <h5
                class="text-uppercase font-weight-normal py-4 mb-0"
                v-if="categoryType == '/vocabulary/'"
            >словарь по темам</h5>
            <v-card
                rounded="lg"
                elevation="0"
                class="mx-auto"
            >
                <v-list-item>
                    <v-list-item-content class="px-2 py-4">
                        <v-list-item-title
                            v-for="(category, i) in categories"
                            :key="i"
                            class="mt-1"
                        >
                            <a
                                target="_blank"
                                :href="`${categoryType}` + category.slug"
                                class="title-links"
                            >
                                {{ category.name }}
                            </a>

                            <v-list-item-subtitle
                                v-for="(subCategory, i) in category.children"
                                :key="i"
                                class="my-2"
                            >
                                <a
                                    target="_blank"
                                    :href="`${categoryType}` + subCategory.slug"
                                    class="subtitle-links"
                                >
                                    <span>{{ subCategory.name }}</span>
                                </a>
                            </v-list-item-subtitle>
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-card>

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
                } else if (category.type === 'App\\Quote') {
                    return '/quotes/';
                } else if (category.type === 'App\\Term') {
                    return '/terms/';
                } else if (category.type === 'App\\Video') {
                    return '/videos/';
                }
            }
        }
    },
};
</script>

<style scoped>
.title-links {
    text-decoration: none;
    font-size: 15px;
    font-weight: 700;
    color: #000;
}

.subtitle-links {
    font-weight: 400;
    color: #000;
    font-size: 15px;
}

.title-links:hover,
.subtitle-links:hover {
    color: #04718c !important;
    text-decoration: none;
}

button:focus {
    outline: none;
}
</style>

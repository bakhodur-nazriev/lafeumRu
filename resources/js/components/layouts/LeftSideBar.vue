<template>
    <v-col xl="2" lg="2" md="3">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">темы</h5>
        <v-sheet class="pa-2" rounded="lg" width="100%">
            <!-- Category -->

            <v-list-item v-for="(category, i) in categories" :key="i">
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

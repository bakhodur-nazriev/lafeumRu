<template>
    <v-col lg="3" xl="2">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">темы</h5>
        <v-sheet class="pa-2" rounded="lg" width="100%">
            <!-- Category -->
            <div v-for="(icon ,i) in categoryIcons" :key="i">

                <v-list-item
                    v-for="(category, i) in allCategories"
                    :key="i"
                >
                    <v-list-item-content two-line>
                        <v-list-item-title class="mb-3">
                            <a class="font-weight-bold" :href="category.slug">{{ category.name }}</a>
                        </v-list-item-title>
                        <v-list-item-subtitle class="my-1" v-for="(subCategory ,i) in category.children" :key="i">
                            <a :href="subCategory.slug">{{ subCategory.name }}</a>
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>

            </div>
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
            categoryIcons: [
                {icon: "mdi-briefcase-variant"},
                {icon: "mdi-account-group"},
                {icon: "mdi-atom"},
                {icon: "mdi-emoticon-excited-outline"}
            ]
        }
    },
    computed: {
        icons() {
            for (const icon of this.categoryIcons) {
                console.log(icon.icon)
            }
        }
    },
    created() {
        console.log(this.categories)
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

.deep-expansion-panel {
    margin: 0;
}

.v-expansion-panel--active >
.v-expansion-panel-header {
    min-height: 50px;
}

.v-expansion-panel-content__wrap {
    padding: 0 24px !important;
}

.deep-sub-expansion-panel-header {
    padding: 0 24px;
    min-height: 30px;
}

.deep-expansion-panel-header {
    min-height: 30px;
}
</style>

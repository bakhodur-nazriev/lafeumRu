<template>
    <v-col lg="3" xl="2">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">темы</h5>
        <v-sheet class="pa-2" rounded="lg" width="100%">
            <!-- Category -->

            <v-list-item
                v-for="(category, i) in allCategories"
                :key="i"
            >
                <v-list-item-content two-line>
                    <v-list-item-title class="mb-3">
                        <a class="font-weight-bold subtitle-1 category-links" :href="category.slug">{{ category.name }}</a>
                    </v-list-item-title>
                    
                    <v-list-item-subtitle v-for="(subCategory ,i) in category.children" :key="i">
                        <a :href="subCategory.slug" class="subtitle-1 category-links">{{ subCategory.name }}</a>
                    </v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>

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
    }
}
</script>

<style scoped>
button:focus {
    outline: none;
}

.category-links{
    color: #676767;

}

.category-links:hover{
    text-decoration: none;
    color: #04718c;
}
</style>

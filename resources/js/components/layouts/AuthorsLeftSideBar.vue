<template>
    <v-col lg="3" xl="2">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">поиск по имени</h5>

        <v-sheet rounded="lg" width="100%">
            <div class="d-flex align-center pa-5">
                <v-icon>mdi-account-group-outline</v-icon>
                <h5 class="ml-2 mb-0">{{ currentList }}</h5>
                <!--                <h5 class="ml-2 mb-0" v-esle>Авторы</h5>-->
            </div>
            <v-divider class="ma-0"></v-divider>
            <div class="pa-6">
                <v-text-field
                    label="Введите имя автора"
                    v-model="search"
                    hide-details
                    class="mb-1"
                    outlined
                    dense
                >
                </v-text-field>

                <!-- Authors -->
                <div v-if="loading">
                    <h5 class="text-uppercase font-weight-regular py-4">загурзка...</h5>
                </div>
                <div v-else>
                    <v-list-item
                        v-for="(author, i) in filteredList"
                        :key="i"
                        class="authors-list pl-1"
                    >
                        <v-list-item-content class="py-0">
                            <v-list-item-subtitle>
                                <a class="author-links font-weight-medium" :href="author.slug">{{ author.name }}</a>
                            </v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </div>
            </div>
        </v-sheet>
    </v-col>
</template>

<script>
export default {
    props: ["authors", "current", "authorListTitle"],
    data() {
        return {
            // authors: [],
            search: "",
            loading: false,
            currentList: this.authorListTitle
        }
    },

    created() {
        console.log(this.listTitle);
    },
    // methods: {
    //     getAuthors() {
    //         this.loading = true;
    //         axios
    //             .get("/api/authors")
    //             .then(res => {
    //                 this.loading = false;
    //                 this.authors = res.data;
    //                 console.log(res.data);
    //             })
    //             .catch(err => {
    //                 this.loading = false;
    //                 console.log(err);
    //             })
    //     }
    // },
    // mounted() {
    //     this.getAuthors();
    // },
    computed: {
        filteredList() {
            return this.authors.filter(author => {
                return author.name.toLowerCase().includes(this.search.toLowerCase())
            })
        },
        listTitle() {
            return this.authorListTitle
        }
    }
}
</script>

<style scoped>
.authors-list {
    min-height: 28px;
    padding: 0;
}

.author-links {
    text-decoration: none;
    color: #676767;
}

.author-links:hover {
    color: #04718c;
}
</style>

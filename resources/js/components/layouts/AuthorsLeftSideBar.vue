<template>
    <v-col lg="3" xl="2">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">поиск по имени</h5>

        <v-sheet rounded="lg" width="100%">
            <div class="d-flex align-center pa-5">
                <v-icon>mdi-account-group-outline</v-icon>
                <!--                <h5 class="ml-2 mb-0">{{ currentList }}</h5>-->
                <!--                <h5 class="ml-2 mb-0" v-esle>Авторы</h5>-->
            </div>
            <v-divider class="ma-0"></v-divider>
            <div class="pa-6">
                <v-text-field
                    label="Введите имя автора"
                    v-model="search"
                    hide-details
                    class="mb-3"
                    @click:clear="this.filteredList = !this.filteredList"
                    clearable
                    outlined
                    dense
                >
                </v-text-field>

                <!-- Authors -->
                <v-col cols="12" class="d-flex justify-center" v-if="loading">
                    <v-progress-circular
                        width="5"
                        size="48"
                        indeterminate
                        color="primary"
                    ></v-progress-circular>
                </v-col>
                <div v-else>
                    <v-list-item
                        v-for="(author, i) in filteredList"
                        :key="i"
                        class="authors-list pl-1"
                    >
                        <v-list-item-content class="py-0">
                            <v-list-item-subtitle>
                                <a
                                    class="author-links font-weight-medium"
                                    :href="author.slug"
                                >
                                    {{ author.name }}
                                </a>
                            </v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                    <v-col cols="12" class="d-flex justify-center mt-2 pb-0">
                        <v-btn
                            fab
                            small
                            rounded
                            elevation="0"
                            color="grey lighten-2"
                            @click="loadMore"
                        >
                            <v-icon color="white">mdi-arrow-down</v-icon>
                        </v-btn>
                    </v-col>
                </div>
            </div>
        </v-sheet>
    </v-col>
</template>

<script>
export default {
    data() {
        return {
            authors: [],
            search: "",
            loading: false,
            nextPageUrl: "",
        }
    },
    methods: {
        getAuthors() {
            this.loading = true;
            const url = this.nextPageUrl ? this.nextPageUrl : "/api/authors-left-sidebar?page=" + 1;
            axios
                .get(url)
                .then(res => {
                    this.loading = false;
                    if (res.data.data.length) {
                        this.authors.push(...res.data.data);
                    }
                    this.nextPageUrl = res.data.next_page_url;
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err);
                })
        },
        loadMore() {
            this.getAuthors();
        }
    },
    mounted() {
        this.getAuthors();
    },
    computed: {
        filteredList() {
            if (this.search) {
                return this.authors.filter(author => {
                    if (author.name) {
                        return author.name.toLowerCase().includes(this.search.toLowerCase());
                    }
                });
            } else {
                return this.authors;
            }
        },
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

<template>
    <v-col xl="2" lg="3" class="fill-height authors-main-left-block col-12 px-md-0">
        <v-col class="hidden-sm-and-up pa-0">
            <v-expansion-panels flat>
                <v-expansion-panel>
                    <v-expansion-panel-header>
                        Авторы
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                        <div class="py-4 px-0">
                            <v-text-field
                                label="Введите имя автора"
                                v-model="search"
                                hide-details
                                class="mb-3"
                                @click:clear="clearAuthors()"
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
                                <v-col
                                    cols="12"
                                    class="d-flex justify-center mt-2 pb-0"
                                >
                                    <v-btn
                                        fab
                                        small
                                        rounded
                                        elevation="0"
                                        :disabled="isDisabled"
                                        color="grey lighten-2"
                                        @click="loadMore"
                                    >
                                        <v-icon color="white">mdi-arrow-down</v-icon>
                                    </v-btn>
                                </v-col>
                            </div>
                        </div>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-col>

        <v-col class="fill-height hidden-xs-only py-0">
            <h5 class="text-uppercase font-weight-normal py-4">поиск по имени</h5>

            <v-sheet rounded="lg" width="100%">
                <div class="d-flex align-center pa-3">
                    <v-icon>mdi-account-group-outline</v-icon>
                    <h5 class="ml-2 mb-0" v-if="listTitle">{{ listTitle }}</h5>
                    <h5 class="ml-2 mb-0" v-else>Авторы</h5>
                </div>
                <v-divider class="ma-0"></v-divider>
                <div class="pa-5">
                    <v-text-field
                        label="Введите имя автора"
                        v-model="search"
                        hide-details
                        class="mb-3"
                        @click:clear="clearAuthors()"
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
                        <v-col
                            cols="12"
                            class="d-flex justify-center pb-0"
                            v-if="!isDisabled"
                        >
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
    </v-col>
</template>

<script>
export default {
    data() {
        return {
            authors: [],
            isDisabled: false,
            listTitle: "",
            search: "",
            loading: false,
            authorsQuantity: 25
        }
    },
    methods: {
        getAuthors() {
            this.loading = true;
            axios
                .get("/api/authors")
                .then((res) => {
                    this.loading = false;
                    this.authors = res.data;

                    if (this.filteredList.length == res.data.length) {
                        this.isDisabled = true;
                    }
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err);
                })
        },
        loadMore() {
            this.authorsQuantity += 25;
        },
        clearAuthors() {
            this.filteredList = this.authors;
        }
    },
    mounted() {
        this.getAuthors();
    },
    computed: {
        filteredList: {
            get() {
                if (this.search) {
                    let allFilteredAuthors = this.authors.filter(author => {
                        if (author.name) {
                            return author.name.toLowerCase().includes(this.search.toLowerCase());
                        }
                    });
                    let certainFilteredAuthors = allFilteredAuthors.filter((a, i) => i < this.authorsQuantity);
                    if (certainFilteredAuthors.length == allFilteredAuthors.length) {
                        this.isDisabled = true;
                    } else {
                        this.isDisabled = false;
                    }
                    return certainFilteredAuthors;
                } else {
                    this.isDisabled = false;
                    return this.authors.filter((a, i) => i < this.authorsQuantity);
                }
            },
            set(v) {
                this.authors = v;
            }
        },
    },
    watch: {
        search() {
            this.authorsQuantity = 25;
        }
    }
}
</script>

<style scoped>
.authors-list {
    min-height: 24px;
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

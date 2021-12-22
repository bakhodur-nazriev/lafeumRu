<template>
    <v-col xl="2" lg="3" class="fill-height authors-main-left-block col-12 px-md-0">
        <v-col class="hidden-sm-and-up pa-0">
            <v-expansion-panels flat>
                <v-expansion-panel>
                    <v-expansion-panel-header>
                        <span class="text-uppercase font-weight-medium" v-if="listTitle">{{ listTitle }}</span>
                        <span class="text-uppercase font-weight-medium" v-else>Авторы</span>
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                        <div class="py-4 px-0">
                            <v-text-field
                                dense
                                outlined
                                clearable
                                class="mb-3"
                                hide-details
                                v-model="search"
                                label="Введите имя автора"
                                @click:clear="clearAuthors()"
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
                                <v-card
                                    elevation="0"
                                    max-height="1000"
                                    class="overflow-y-auto"
                                    v-scroll.self="onScroll"
                                >
                                    <v-list-item
                                        v-for="(author, i) in filteredList"
                                        :key="i"
                                        class="authors-list pl-1"
                                    >
                                        <v-list-item-content class="py-0">
                                            <v-list-item-subtitle>
                                                <a
                                                    class="author-links"
                                                    :href="author.slug"
                                                    target="_blank"
                                                >
                                                    {{ author.name }}
                                                </a>
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-card>
                            </div>
                        </div>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-col>

        <v-col class="fill-height hidden-xs-only py-0">
            <h5 class="text-uppercase font-weight-normal py-4">поиск по имени</h5>
            <v-sheet
                rounded="lg"
                width="100%"
            >
                <v-col class="d-flex align-center pa-3">
                    <v-icon>mdi-account-group-outline</v-icon>
                    <h5 class="ml-2 mb-0" v-if="listTitle">{{ listTitle }}</h5>
                    <h5 class="ml-2 mb-0" v-else>Авторы</h5>
                </v-col>
                <v-divider class="ma-0"></v-divider>
                <div class="pa-5">
                    <v-text-field
                        @click:clear="clearAuthors()"
                        label="Введите имя автора"
                        v-model="search"
                        hide-details
                        class="mb-3"
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
                    <v-col class="pa-0" v-else>
                        <v-card
                            elevation="0"
                            max-height="1000"
                            class="overflow-y-auto"
                            v-scroll.self="onScroll"
                        >
                            <v-list-item
                                v-for="(author, i) in filteredList"
                                :key="i"
                                class="authors-list pl-1"
                            >
                                <v-list-item-content class="py-0">
                                    <v-list-item-subtitle>
                                        <a
                                            class="author-links"
                                            :href="author.slug"
                                            target="_blank"
                                        >
                                            {{ author.name }}
                                        </a>
                                    </v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-card>
                    </v-col>
                </div>
            </v-sheet>
        </v-col>
    </v-col>
</template>

<script>
export default {
    data() {
        return {
            search: "",
            authors: [],
            listTitle: "",
            loading: false,
            scrollInvoked: 0,
        }
    },
    methods: {
        getAuthors() {
            this.loading = true;
            axios
                .get("/api/front/authors")
                .then((res) => {
                    this.loading = false;
                    this.authors = res.data;
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err);
                })
        },
        clearAuthors() {
            this.filteredList = this.authors;
        },
        onScroll() {
            this.scrollInvoked++;
        },
    },
    mounted() {
        this.getAuthors();
    },
    computed: {
        filteredList: {
            get() {
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
            set(v) {
                this.authors = v;
            }
        },
    },
}
</script>

<style scoped>
.authors-list {
    min-height: 24px;
    padding: 0;
}

.author-links {
    text-decoration: none;
    color: #000;
}

.author-links:hover {
    color: #04718c;
}

::-webkit-scrollbar {
    width: 5px;
}
</style>

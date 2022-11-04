<template>
    <v-col xl="7" lg="8" order="3" order-lg="2">
        <h5 class="text-uppercase font-weight-regular py-4 pb-2">Авторы</h5>
        <p>Полный список всех авторов по алфавиту, а также есть возможность поиска.</p>
        <v-col sm="12" md="7" class="d-flex align-items-center pl-0 mb-3">
            <v-col class="d-flex rounded-lg pa-0">
                <v-text-field
                    solo
                    flat
                    dense
                    clearable
                    height="41"
                    hide-details
                    v-model="search"
                    @click:clear="clearAuthors()"
                    background-color="transparent"
                    placeholder="Введите имя автора"
                    class="rounded-lg rounded-tr-0 rounded-br-0 search-field"
                >
                </v-text-field>
                <v-btn
                    depressed
                    height="45"
                    color="primary"
                    class="text-capitalize rounded-0 rounded-br-lg rounded-tr-lg"
                >
                    Поиск
                </v-btn>
            </v-col>
        </v-col>
        <v-col cols="12" class="d-flex justify-center" v-if="loading">
            <v-progress-circular
                width="5"
                size="48"
                indeterminate
                color="primary"
            ></v-progress-circular>
        </v-col>
        <v-row v-else>
            <v-col
                v-for="(authors, i) in filteredAuthors"
                :key="i"
                class="fill-height col-lg-4 col-md-6"
            >
                <v-card rounded="lg" class="px-6 py-4" flat>
                    <v-card-text
                        v-for="(author ,i) in authors"
                        class="pa-0"
                        :key="i"
                    >
                        <a
                            :href="'/authors/' + author.slug"
                            class="author-words text-decoration-none d-block fit"
                            target="_blank"
                        >
                            {{ author.name }}
                        </a>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-col>
</template>

<script>

export default {
    name: "Authors",
    data() {
        return {
            search: "",
            authors: [],
            loading: false,
            cols: 3,
            widthOfWindow: window.innerWidth
        };
    },
    methods: {
        getAuthors() {
            this.loading = true;
            axios
                .get("/api/front/authors")
                .then(res => {
                    this.loading = false;
                    this.authors = res.data;
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err);
                })
        },
        clearAuthors() {
            this.filteredAuthors = this.authors;
        }
    },
    mounted() {
        this.getAuthors();
    },
    computed: {
        columns() {
            let columns = [];
            let mid = Math.floor(this.authors.length / this.cols);

            if (this.widthOfWindow > 960) {
                for (let col = 0; col < this.cols; col++) {
                    columns.push(this.authors.slice(col * mid, col * mid + mid));
                }
            } else {
                columns.push(this.authors);
            }

            return columns;
        },
        filteredAuthors: {
            get() {
                if (this.search) {
                    return this.columns.map(authors => {
                        return authors.filter(author => {
                            return author.name.toLowerCase().includes(this.search.toLowerCase());
                        })
                    });
                } else {
                    return this.columns;
                }
            },
            set(v) {
                this.authors = v;
            }
        },
    },
};
</script>

<style scoped>
.search-field {
    border: 2px solid #9B9B9B;
    border-right: none;
}

.author-words {
    color: #494949;
    width: fit-content;
    text-overflow: ellipsis;
    overflow: hidden;
    max-width: 100%;
    min-height: 22px;
    white-space: nowrap;
}

.author-words:hover {
    color: #1a718c;
}
</style>

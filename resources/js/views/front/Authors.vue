<template>
    <v-col xl="7" lg="9">
        <h5 class="text-uppercase font-weight-regular py-4 pb-2">Авторы</h5>
        <p class="grey--text">Авторы. Полный список всех авторов по алфавиту, а также есть возможность поиска.</p>
        <v-col cols="7" class="d-flex align-items-center pl-0 mb-6">
            <div class="form-search rounded-lg w-100">
                <v-text-field
                    solo
                    flat
                    clearable
                    height="48"
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
                    height="52"
                    color="primary"
                    class="text-capitalize rounded-0 rounded-br-lg rounded-tr-lg"
                >
                    Поиск
                </v-btn>
            </div>
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
                cols="4"
                :key="i"
                v-for="(authors, i) in filteredAuthors"
                class="fill-height"
            >
                <v-card rounded="lg" class="px-6 py-4" flat>
                    <v-card-text
                        v-for="(author ,i) in authors"
                        class="pa-1"
                        :key="i"
                    >
                        <list-of-author :item="author"></list-of-author>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-col>
</template>

<script>
import ListOfAuthor from "../../components/ListOfChildren/ListOfAuthor";

export default {
    components: {
        ListOfAuthor
    },
    name: "Authors",
    data() {
        return {
            search: "",
            authors: [],
            loading: false,
            cols: 3
        };
    },
    methods: {
        getAuthors() {
            this.loading = true;
            axios
                .get("/api/authors")
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
        orderAuthors() {
            let allAuthors = this.authors.reduce((r, e) => {
                let group = e.name[0];
                if (!r[group]) r[group] = {group, children: [e]}
                else r[group].children.push(e);
                return r;
            }, {})
            return Object.values(allAuthors);
        },
        columns() {
            let columns = [];
            let mid = Math.ceil(this.orderAuthors.length / this.cols);
            for (let col = 0; col < this.cols; col++) {
                columns.push(this.orderAuthors.slice(col * mid, col * mid + mid));
            }
            return columns;
        },
        filteredAuthors: {
            get() {
                if (this.search) {
                    return this.columns.map(authors => {
                        return authors.map(author => {
                            const children = author.children.filter(child => {
                                return child.name.toLowerCase().includes(this.search.toLowerCase()) || this.search.includes(child.name)
                            });
                            return {...author, children}
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
/*.authors-link:hover {*/
/*    color: #212529;*/
/*}*/

/*.list-inline {*/
/*    padding-left: 15px;*/
/*    list-style: none;*/
/*}*/

/*.list-col-4 {*/
/*    column-count: 3;*/
/*}*/

.form-search {
    display: flex;
}

.search-field {
    border: 2px solid #9B9B9B;
    border-right: none;
}
</style>

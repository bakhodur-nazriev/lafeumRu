<template>
    <v-col xl="7" lg="9">
        <h5 class="text-uppercase font-weight-regular py-4">Авторы</h5>
        <p class="grey--text">Авторы. Полный список всех авторов по алфавиту, а также есть возможность поиска.</p>
        <v-col cols="8" class="d-flex align-items-center pl-0 mb-9">
            <div class="form-search rounded-lg w-100">
                <v-text-field
                    solo
                    flat
                    clearable
                    height="48"
                    hide-details
                    v-model="search"
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
            <ul class="list-inline py-1 list-col-4">
                <li v-for="(author ,i) in filteredList" :key="i" class="my-2">
                    <a :href="`/authors/`+author.slug">{{ author.name }}</a>
                </li>
            </ul>
        </v-row>
        <scroller></scroller>
    </v-col>
</template>

<script>
import Scroller from "../../components/Scroller";
export default {
    components: {Scroller},
    name: "Authors",
    data() {
        return {
            search: "",
            authors: [],
            loading: false
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
        }
    },
    mounted() {
        this.getAuthors();
    },
    computed: {
        filteredList() {
            return this.authors.filter(author => {
                return author.name.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }
};
</script>

<style scoped>
.list-inline {
    padding-left: 15px;
    list-style: none;
}

.list-col-4 {
    column-count: 3;
}

.form-search {
    display: flex;
}

.search-field {
    border: 2px solid #9B9B9B;
    border-right: none;
}
</style>

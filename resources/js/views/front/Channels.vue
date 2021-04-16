<template>
    <v-col xl="7" lg="9">
        <h5 class="text-uppercase font-weight-regular py-4">Каналы</h5>
        <p class="grey--text">Каналы. Полный список всех авторов по алфавиту, а также есть возможность поиска.</p>
        <v-col cols="8" class="d-flex align-items-center pl-0 mb-9">
            <div class="form-search rounded-lg w-100">
                <v-text-field
                    solo
                    clearable
                    height="52"
                    hide-details
                    v-model="search"
                    background-color="transparent"
                    placeholder="Введите имя канала"
                    class="rounded-lg rounded-tr-0 rounded-br-0"
                >
                </v-text-field>
                <v-btn
                    depressed
                    height="52"
                    color="primary"
                    class="text-capitalize rounded-0"
                >
                    Поиск
                </v-btn>
            </div>
        </v-col>
        <v-col cols="12" class="d-flex justify-center" v-if="loading">
            <h5 class="text-uppercase font-weight-regular py-4">загурзка...</h5>
        </v-col>
        <div class="row" v-else>
            <ul class="list-inline py-1 list-col-4">
                <li v-for="(channel, i) in filteredList" :key="i">
                    <a :href="`/channels/` + channel.slug" class="channels-links">{{ channel.name }}</a>
                </li>
            </ul>
        </div>
        <v-btn
            fab
            dark
            color="primary"
            @click="scrollToTop"
        >
            <v-icon dark>mdi-chevron-up</v-icon>
        </v-btn>
        <!--        <v-btn @click="scrollToDown" icon>-->
        <!--            <v-icon>mdi-chevron-down</v-icon>-->
        <!--        </v-btn>-->
    </v-col>
</template>

<script>
export default {
    name: "Channels",
    data() {
        return {
            channels: [],
            loading: false,
            search: ""
        }
    },
    methods: {
        getChannels() {
            this.loading = true;
            axios
                .get("/api/channels")
                .then(res => {
                    this.loading = false;
                    this.channels = res.data;
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err);
                })
        },
        scrollToTop() {
            window.scrollTo(0, 0);
        }
    },
    mounted() {
        this.getChannels();
    },
    computed: {
        filteredList() {
            return this.channels.filter(channel => {
                return channel.name.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }
}
</script>

<style scoped>
.list-inline {
    padding-left: 15px;
    list-style: none;
}

.list-col-4 {
    column-count: 3;
}

.channels-links {
    line-height: 2;
}


.form-search {
    display: flex;
    border: 2px solid #1a718c;
}
</style>

<template>
    <v-col xl="7" lg="9">
        <h5 class="text-uppercase font-weight-regular pt-4 pb-2">Каналы</h5>
        <p class="grey--text">Каналы. Полный список всех авторов по алфавиту, а также есть возможность поиска.</p>
        <v-col cols="7" class="d-flex align-items-center pl-0 mb-9">
            <div class="form-search rounded-lg w-100">
                <v-text-field
                    solo
                    flat
                    clearable
                    height="48"
                    hide-details
                    v-model="search"
                    @click:clear="clearChannel()"
                    background-color="transparent"
                    placeholder="Введите имя канала"
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
        <div class="row" v-else>
            <v-col cols="6" v-for="(channels, i) in filteredChannels" :key="i">
                <v-card rounded="lg" class="px-8 py-5" flat>
                    <v-card-text
                        class="pa-1"
                        v-for="(channel ,i) in channels"
                        :key="i"
                    >
                        <list-of-channel :item="channel"></list-of-channel>
                    </v-card-text>
                </v-card>
            </v-col>
        </div>
    </v-col>
</template>

<script>
import ListOfChannel from "../../components/ListOfChildren/ListOfChannel";

export default {
    name: "Channels",
    components: {ListOfChannel},
    data() {
        return {
            channels: [],
            loading: false,
            search: "",
            cols: 2
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
        clearChannel() {
            this.filteredChannels = this.channels;
        }
    },
    mounted() {
        this.getChannels();
    },
    computed: {
        orderChannels() {
            let allChannels = this.channels.reduce((r, e) => {
                let group = e.name[0];
                if (!r[group]) r[group] = {group, children: [e]}
                else r[group].children.push(e);
                return r;
            }, {})
            return Object.values(allChannels);
        },
        columns() {
            let columns = [];
            let mid = Math.ceil(this.orderChannels.length / this.cols);
            for (let col = 0; col < this.cols; col++) {
                columns.push(this.orderChannels.slice(col * mid, col * mid + mid));
            }
            return columns;
        },
        filteredChannels: {
            get() {
                if (this.search) {
                    return this.columns.map(channels => {
                        return channels.map(channel => {
                            const children = channel.children.filter(child => {
                                return child.name.toLowerCase().includes(this.search.toLowerCase()) || this.search.includes(child.name)
                            });
                            return {...channel, children}
                        })
                    });
                } else {
                    return this.columns;
                }
            },
            set(v) {
                this.channels = v;
            }
        },
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
}

.search-field {
    border: 2px solid #9B9B9B;
    border-right: none;
}
</style>

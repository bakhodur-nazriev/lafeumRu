<template>
    <v-col xl="7" lg="8">
        <h5 class="text-uppercase font-weight-regular pt-4 pb-2">Каналы</h5>
        <p class="grey--text">Каналы. Полный список всех авторов по алфавиту, а также есть возможность поиска.</p>
        <v-col sm="12" md="7" class="d-flex align-items-center px-0 mb-5">
            <v-col class="d-flex rounded-lg pa-0">
                <v-text-field
                    solo
                    flat
                    clearable
                    height="48"
                    hide-details
                    v-model="search"
                    @click:clear="clearChannel()"
                    background-color="transparent"
                    placeholder="Введите название канала"
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
        <div class="row" v-else>
            <v-col
                class="fill-height col-md-4 col-12"
                v-for="(channels, i) in filteredChannels"
                :key="i"
            >
                <v-card rounded="lg" class="px-6 py-4" flat>
                    <v-card-text
                        v-for="(channel ,i) in channels"
                        class="pa-1"
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
            cols: 3
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
                let group = e.name[0].toUpperCase();
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
.search-field {
    border: 2px solid #9B9B9B;
    border-right: none;
}
</style>

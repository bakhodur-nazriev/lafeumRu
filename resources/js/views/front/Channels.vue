<template>
    <v-col xl="7" lg="8" order="3" order-lg="2">
        <h5 class="text-uppercase font-weight-regular pt-4 pb-2">Каналы</h5>
        <p>Каналы. Полный список всех авторов по алфавиту, а также есть возможность поиска.</p>
        <v-col sm="12" md="6" class="d-flex align-items-center px-0 mb-3">
            <v-col class="d-flex rounded-lg pa-0">
                <v-text-field
                    solo
                    flat
                    dense
                    clearable
                    height="41"
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
        <div class="row" v-else>
            <v-col
                class="fill-height col-md-4 col-12"
                v-for="(channels, i) in filteredChannels"
                :key="i"
            >
                <v-card rounded="lg" class="px-6 py-4" flat>
                    <v-card-text
                        v-for="(channel ,i) in channels"
                        class="pa-0"
                        :key="i"
                    >
                        <a
                            class="vocabulary-words text-decoration-none d-block"
                            :href="'/channels/' + channel.slug"
                            target="_blank"
                        >
                            {{ channel.name }}
                        </a>
                    </v-card-text>
                </v-card>
            </v-col>
        </div>
    </v-col>
</template>

<script>

export default {
    name: "Channels",
    data() {
        return {
            channels: [],
            loading: false,
            search: "",
            cols: 3,
            widthOfWindow: window.innerWidth
        }
    },
    methods: {
        getChannels() {
            this.loading = true;
            axios
                .get("/api/front/channels")
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
        columns() {
            let columns = [];
            let mid = Math.floor(this.channels.length / this.cols);

            if (this.widthOfWindow > 960) {
                for (let col = 0; col < this.cols; col++) {
                    columns.push(this.channels.slice(col * mid, col * mid + mid));
                }
            } else {
                columns.push(this.channels);
            }

            return columns;
        },
        filteredChannels: {
            get() {
                if (this.search) {
                    return this.columns.map(channels => {
                        return channels.filter(channel => {
                            return channel.name.toLowerCase().includes(this.search.toLowerCase())
                        });
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

.vocabulary-words {
    color: #494949;
    width: fit-content;
    text-overflow: ellipsis;
    overflow: hidden;
    max-width: 100%;
    min-height: 22px;
    white-space: nowrap;
}

.vocabulary-words:hover {
    color: #1a718c;
}
</style>

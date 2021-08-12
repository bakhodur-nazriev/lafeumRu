<template>
    <v-col lg="3" xl="2" class="hidden-xs-only">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">поиск по каналам</h5>

        <v-sheet rounded="lg" width="100%">
            <div class="d-flex align-center pa-5">
                <v-icon>mdi-account-group-outline</v-icon>
                <h5 class="ml-2 mb-0">Каналы</h5>
            </div>
            <v-divider class="ma-0"></v-divider>
            <div class="pa-6">
                <v-text-field
                    @click:clear="clearChannels()"
                    label="Введите имя канала"
                    v-model="search"
                    hide-details
                    class="mb-3"
                    clearable
                    outlined
                    dense
                >
                </v-text-field>

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
                        v-for="(channel, i) in filteredList"
                        :key="i"
                        class="channels-list pl-1"
                    >
                        <v-list-item-content class="py-0">
                            <v-list-item-subtitle>
                                <a
                                    class="channels-links font-weight-medium"
                                    :href="channel.slug"
                                >
                                    {{ channel.name }}
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
                            :disabled="isDisabled"
                            color="grey lighten-2"
                            @click="loadMore()"
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
    name: "ChannelsLeftSideBar",
    data() {
        return {
            channels: [],
            isDisabled: false,
            windowUrl: window.location.pathname,
            loading: false,
            search: "",
            nextPageUrl: ""
        }
    },
    methods: {
        getChannels() {
            this.loading = true;
            const url = this.nextPageUrl ? this.nextPageUrl : `/api${this.windowUrl}?page=` + 1;
            axios
                .get(url)
                .then((res) => {
                    console.log(res.data);
                    this.loading = false;
                    if (res.data[1].data.length) {
                        this.channels.push(...res.data[1].data);
                    }

                    if (res.data[1].to == res.data[1].total) {
                        this.isDisabled = true;
                    }

                    this.nextPageUrl = res.data[1].next_page_url;
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err);
                })
        },
        loadMore() {
            this.getChannels();
        },
        clearChannels() {
            this.filteredList = this.channels;
        },
    },
    mounted() {
        this.getChannels();
    },
    computed: {
        filteredList: {
            get() {
                if (this.search) {
                    return this.channels.filter(channel => {
                        return channel.name.toLowerCase().includes(this.search.toLowerCase())
                    });
                } else {
                    return this.channels;
                }
            },
            set(v) {
                this.channels = v;
            }
        }
    }
}
</script>

<style scoped>
.channels-links {
    text-decoration: none;
    color: #676767;
}

.channels-list {
    min-height: 28px;
    padding: 0;
}

.channels-links:hover {
    color: #04718c;
}
</style>

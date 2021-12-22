<template>
    <v-col xl="2" lg="3" class="left-side-channel-block col-12 px-md-0">
        <v-col class="hidden-sm-and-up pa-0">
            <v-expansion-panels flat>
                <v-expansion-panel>
                    <v-expansion-panel-header class="text-uppercase font-weight-medium">
                        Каналы
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                        <div>
                            <v-text-field
                                dense
                                outlined
                                clearable
                                class="mb-3"
                                hide-details
                                v-model="search"
                                label="Введите имя канала"
                                @click:clear="clearChannels()"
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
                                <v-card
                                    elevation="0"
                                    max-height="1000"
                                    class="overflow-y-auto"
                                    v-scroll.self="onScroll"
                                >
                                    <v-list-item
                                        v-for="(channel, i) in filteredList"
                                        :key="i"
                                        class="channels-list pl-1"
                                    >
                                        <v-list-item-content class="py-0">
                                            <v-list-item-subtitle>
                                                <a
                                                    class="channels-links"
                                                    :href="channel.slug"
                                                    target="_blank"
                                                >
                                                    {{ channel.name }}
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
            <h5 class="text-uppercase font-weight-normal py-4 mb-0">поиск по каналам</h5>
            <v-sheet rounded="lg" width="100%">
                <div class="d-flex align-center pa-3">
                    <v-icon>mdi-account-group-outline</v-icon>
                    <h5 class="ml-2 mb-0">Каналы</h5>
                </div>
                <v-divider class="ma-0"></v-divider>
                <div class="pa-5">
                    <v-text-field
                        dense
                        outlined
                        clearable
                        class="mb-3"
                        hide-details
                        v-model="search"
                        label="Введите имя канала"
                        @click:clear="clearChannels()"
                    >
                    </v-text-field>

                    <!-- Channels -->
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
                                v-for="(channel, i) in filteredList"
                                :key="i"
                                class="channels-list pl-1"
                            >
                                <v-list-item-content class="py-0">
                                    <v-list-item-subtitle>
                                        <a
                                            class="channels-links"
                                            :href="channel.slug"
                                            target="_blank"
                                        >
                                            {{ channel.name }}
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
    name: "ChannelsLeftSideBar",
    data() {
        return {
            search: "",
            channels: [],
            loading: false,
            scrollInvoked: 0,
            isDisabled: false,
        }
    },
    methods: {
        getChannels() {
            this.loading = true;
            axios
                .get("/api/front/channels")
                .then((res) => {
                    this.loading = false;
                    this.channels = res.data;
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err);
                })
        },
        onScroll() {
            this.scrollInvoked++;
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
                        if (channel.name) {
                            return channel.name.toLowerCase().includes(this.search.toLowerCase());
                        }
                    });
                } else {
                    return this.channels;
                }
            },
            set(v) {
                this.channels = v;
            }
        }
    },
}
</script>

<style scoped>
.channels-links {
    text-decoration: none;
    color: #000;
}

.channels-list {
    min-height: 24px;
    padding: 0;
}

.channels-links:hover {
    color: #04718c;
}
</style>

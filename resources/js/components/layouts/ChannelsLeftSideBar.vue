<template>
    <v-col lg="3" xl="2">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">поиск по каналам</h5>

        <v-sheet rounded="lg" width="100%">
            <div class="d-flex align-center pa-5">
                <v-icon>mdi-account-group-outline</v-icon>
                <h5 class="ml-2 mb-0">Каналы</h5>
            </div>
            <v-divider class="ma-0"></v-divider>
            <div class="pa-6">
                <v-text-field
                    label="Введите имя автора"
                    v-model="search"
                    hide-details
                    class="mb-1"
                    clearable
                    outlined
                    dense
                >
                </v-text-field>

                <!-- Authors -->
                <v-list-item
                    v-for="(channel, i) in filteredList"
                    :key="i"
                    class="channels-list pl-1"
                >
                    <v-list-item-content class="py-0">
                        <v-list-item-subtitle>
                            <a :href="channel.slug">{{ channel.name }}</a>
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </div>
            <v-col cols="12" class="d-flex justify-center mt-2">
                <v-btn
                    fab
                    small
                    rounded
                    elevation="0"
                    color="grey lighten-2"
                >
                    <v-icon color="white">mdi-arrow-down</v-icon>
                </v-btn>
            </v-col>
        </v-sheet>
    </v-col>
</template>

<script>
export default {
    name: "ChannelsLeftSideBar",
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
.channels-list {
    min-height: 28px;
    padding: 0;
}
</style>

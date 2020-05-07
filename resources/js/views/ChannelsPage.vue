<template>
    <v-content class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-col md="6">
                    <v-text-field
                        solo
                        class="mb-1"
                        hide-details
                        label="Поиск"
                        append-icon="mdi-magnify"
                        v-model="search"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-data-table
                        :headers="headers"
                        :items="filteredChannels"
                        :items-per-page="itemsPerPage"
                        :page.sync="page"
                        @page-count="pageCount = $event"
                        hide-default-footer
                        class="elevation-1"
                    >
                        <template v-slot:item.action="{ item }">
                            <v-btn
                                fab
                                dark
                                small
                                color="primary"
                                elevation="2"
                                outlined
                                @click="channelToUpdate = { ...item }"
                            >
                                <v-icon dark>mdi-pen</v-icon>
                            </v-btn>
                            <v-btn
                                fab
                                dark
                                small
                                color="error"
                                elevation="2"
                                outlined
                                @click="channelToDelete = item"
                            >
                                <v-icon dark>mdi-delete</v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.description="{ item }">
                            <div
                                v-html="item.description"
                                class="short-paragraph"
                            ></div>
                        </template>
                    </v-data-table>
                </v-col>
                <div class="text-center pt-2">
                    <v-pagination
                        v-model="page"
                        :length="pageCount"
                        :total-visible="7"
                    />
                </div>
            </v-row>
        </v-container>
        <v-tooltip top>
            <template v-slot:activator="{ on }">
                <v-btn
                    bottom
                    color="primary"
                    v-on="on"
                    dark
                    fab
                    fixed
                    right
                    @click="dialogAdd = !dialogAdd"
                >
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>
            <span>Добавить канал</span>
        </v-tooltip>

        <channels-create-dialog v-model="dialogAdd" @created="channelCreated" />

        <channels-edit-dialog
            v-model="channelToUpdate"
            @updated="channelUpdated"
        />

        <channels-delete-dialog
            v-model="channelToDelete"
            @deleted="channelDeleted"
        />
    </v-content>
</template>

<script>
import ChannelsCreateDialog from "./ChannelsCreateDialog";
import ChannelsEditDialog from "./ChannelsEditDialog";
import ChannelsDeleteDialog from "./ChannelsDeleteDialog";

export default {
    components: {
        ChannelsCreateDialog,
        ChannelsEditDialog,
        ChannelsDeleteDialog
    },
    data() {
        return {
            dialogAdd: false,
            dialogDelete: false,
            dialogUpdate: false,
            dialogShow: false,
            channelName: "",
            channelDescription: "",
            channelToDelete: null,
            channelToUpdate: null,
            channelToShow: null,
            channels: [],
            search: "",
            page: 1,
            pageCount: 2,
            itemsPerPage: 12,
            headers: [
                {
                    text: "Название",
                    value: "name",
                    sortable: false
                },
                {
                    text: "Описание",
                    value: "description",
                    sortable: false
                },
                {
                    text: "Действия",
                    value: "action",
                    align: "center",
                    sortable: false,
                    width: "160px"
                }
            ]
        };
    },
    mounted() {
        this.loadChannels();
    },
    methods: {
        loadChannels() {
            axios
                .get("/api/channels")
                .then(res => {
                    this.channels = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },
        channelCreated() {
            this.loadChannels();
            this.dialogAdd = false;
        },
        channelUpdated() {
            this.loadChannels();
            this.channelToUpdate = null;
        },
        channelDeleted() {
            this.loadChannels();
            this.channelToDelete = null;
        }
    },
    computed: {
        filteredChannels() {
            return this.channels.filter(channel => {
                return channel.name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        }
    }
};
</script>

<template>
    <v-content class="pa-0">
        <v-container fluid>
            <v-row justify="center">
                <v-col md="6">
                    <v-text-field
                        class="mb-1"
                        hide-details
                        solo
                        label="Поиск"
                        append-icon="mdi-magnify"
                        v-model="search"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-data-table
                        :headers="headers"
                        :items="filteredVideos"
                        :items-per-page="itemsPerPage"
                        :page.sync="page"
                        @page-count="pageCount = $event"
                        hide-default-footer
                        class="elevation-1"
                        :loading="loadingVideos"
                        loading-text="Загрузка..."
                    >
                        <template v-slot:item.action="{ item }">
                            <v-btn
                                fab
                                dark
                                small
                                color="primary"
                                elevation="2"
                                outlined
                                @click="videoToUpdate = { ...item }"
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
                                @click="videoToDelete = item"
                            >
                                <v-icon dark>
                                    mdi-delete
                                </v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.duration="{ item }">
                            <p v-html="item.duration + ' мин'"></p>
                        </template>
                        <template v-slot:item.link="{ item }">
                            <a :href="item.link" target="_blank">{{
                                item.link
                            }}</a>
                        </template>
                    </v-data-table>
                </v-col>
                <v-col class="text-center pt-2">
                    <v-pagination
                        :total-visible="7"
                        v-model="page"
                        :length="pageCount"
                    ></v-pagination>
                </v-col>
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
            <span>Добавить видео</span>
        </v-tooltip>

        <videos-create-dialog
            v-model="dialogAdd"
            :channels="channels"
            :categories="categories"
            @created="videoCreated"
        />

        <videos-edit-dialog
            v-model="videoToUpdate"
            :channels="channels"
            :categories="categories"
            @updated="videoUpdated"
        />

        <videos-delete-dialog
            v-model="videoToDelete"
            @deleted="videoDeleted"
        />

    </v-content>
</template>

<script>
import rules from "../validation-rules";

import VideosCreateDialog from "./VideosCreateDialog";
import VideosEditDialog from "./VideosEditDialog";
import VideosDeleteDialog from "./VideosDeleteDialog";

export default {
    components: {
        VideosCreateDialog,
        VideosEditDialog,
        VideosDeleteDialog
    },
    data() {
        return {
            rules,
            dialogAdd: false,
            dialogDelete: false,
            dialogUpdate: false,
            newVideo: null,
            videoToDelete: null,
            videoToUpdate: null,
            videos: [],
            loadingVideos: false,
            channels: [],
            categories: [],
            search: "",
            page: 1,
            pageCount: 2,
            itemsPerPage: 12,
            headers: [
                {
                    text: "Названия",
                    value: "title",
                    sortable: false
                },
                {
                    text: "Каналы",
                    value: "channel.name",
                    sortable: false
                },
                {
                    text: "Ссылки",
                    value: "link",
                    sortable: false
                },
                {
                    text: "Время",
                    value: "duration",
                    align: "center",
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
        this.loadVideos();
        this.loadChannels();
        this.loadVideoCategories();
    },
    methods: {
        loadVideos() {
            this.loadingVideos = true;
            axios
                .get("/api/videos")
                .then(res => {
                    this.loadingVideos = false;
                    this.videos = res.data;
                })
                .catch(err => {
                    this.loadingVideos = false;
                    console.log(err);
                });
        },
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
        loadVideoCategories() {
            axios
                .get("/api/categories?type=" + VIDEO_TYPE)
                .then(res => (this.categories = res.data))
                .catch(e => console.log(e));
        },
        videoCreated(newVideo) {
            this.dialogAdd = false;
            this.loadVideos();
        },
        videoUpdated(updated) {
            this.videoToUpdate = null;
            this.loadVideos();
        },
        videoDeleted() {
            this.videoToDelete = null;
            this.loadVideos();
        }
    },
    computed: {
        filteredVideos() {
            return this.videos.filter(video => {
                return video.title
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        }
    }
};
</script>

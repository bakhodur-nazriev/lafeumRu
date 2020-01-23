<template>
    <v-content class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-col cols="6">
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
                    >
                        <template v-slot:item.action="{ item }">
                            <v-btn
                                fab
                                dark
                                small
                                color="primary"
                                elevation="2"
                                outlined
                                @click="videoToUpdate = {...item}"
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
                    </v-data-table>
                </v-col>
                <div class="text-center pt-2">
                    <v-pagination v-model="page" :length="pageCount"></v-pagination>
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
            <span>Добавить видео</span>
        </v-tooltip>

        <!-- Add Item Dialog -->
        <v-dialog v-model="dialogAdd" width="780px">
            <v-card>
                <v-card-title class="primary white--text">
                    Создать Видео
                </v-card-title>
                <v-form>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    outlined
                                    required
                                    v-model="videoTitle"
                                    placeholder="Добаить назавния видео"
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-select
                                    :items="channels"
                                    v-model="videoChannel"
                                    item-value="id"
                                    item-text="name"
                                    label="Выберите канал"
                                    outlined
                                    dense
                                >
                                </v-select>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    label="Добавить ссылку здесь"
                                    outlined
                                    name="link"
                                    v-model="videoLink"
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    label="Добавить продольжительность здесь"
                                    outlined
                                    name="duration"
                                    v-model="videoDuration"
                                >
                                </v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="addVideo()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="() => (dialogAdd = false)">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Delete Item Dialog -->
        <v-dialog v-model="dialogDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center">
                    Вы действительно хотите удалить это видео ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn color="green darken-1" dark @click="videoToDelete = null">
                        Нет
                    </v-btn>
                    <v-btn color="red darken-1" dark @click="deleteVideo()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Update Item Dialog -->
        <v-dialog v-model="dialogUpdate" width="780px">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить Термин
                </v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                outlined
                                name="body"
                                v-model="videoToUpdate.body"
                                placeholder="Изменить термин здесь"
                            >
                            </v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="updateVideo()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="dialogUpdate = false"
                    >Отмена
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Show Quote Dialog -->
        <v-dialog v-model="dialogShowVideo"></v-dialog>
    </v-content>
</template>

<script>
    export default {
        data() {
            return {
                dialogAdd: false,
                dialogDelete: false,
                dialogUpdate: false,
                dialogShowVideo: false,
                videoChannel: '',
                videoTitle: '',
                videoLink: '',
                videoDuration: '',
                videoToDelete: {
                    title: null,
                    channel_id: null,
                    link: null,
                    duration: null
                },
                videoToUpdate: {
                    title: null,
                    channel_id: null,
                    link: null,
                    duration: null
                },
                videos: [],
                channels: [],
                search: "",
                page: 1,
                pageCount: 2,
                itemsPerPage: 12,
                headers: [
                    {
                        text: 'Названия',
                        value: 'title',
                        align: "center",
                        sortable: false,
                    },
                    {
                        text: 'Каналы',
                        value: 'channel.name',
                        align: "center",
                        sortable: false,
                    },
                    {
                        text: 'Ссылки',
                        value: 'link',
                        align: "center",
                        sortable: false
                    },
                    {
                        text: 'Продолжительность',
                        value: 'duration',
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
            }
        },
        mounted() {
            this.loadVideos();
            axios
                .get("/api/channels")
                .then(res => {
                    this.channels = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },
        methods: {
            loadVideos() {
                axios.get('/api/videos').then(res => {
                    this.videos = res.data;
                }).catch(err => {
                    console.log(err);
                });
            },

            addVideo() {
                axios
                    .post('/api/videos/', {
                        'title': this.videoTitle,
                        'channel_id': this.videoChannel,
                        'link': this.videoLink,
                        'duration': this.videoDuration
                    })
                    .then(res => {
                        console.log(res);
                        this.loadVideos();
                        this.dialogAdd = false;
                    })
                    .catch((err) => {
                        console.log(err.res.data)
                    });
            },

            updateVideo() {
                axios
                    .put('/api/videos/' + this.videoToUpdate.id)
                    .then(res => {
                        console.log(res);
                        this.loadVideos();
                        this.dialogUpdate = false;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },

            deleteVideo() {
                axios.delete('/api/videos/' + this.videoToDelete.id).then(res => {
                    console.log(res);
                    this.loadVideos();
                    this.dialogDelete = false;
                    // this.videos = res.data;
                }).catch(err => {
                    console.log(err);
                });
            }
        },
        watch: {
            videoToUpdate(value) {
                if (value) {
                    this.dialogUpdate = true;
                } else {
                    this.dialogUpdate = false;
                }
            },
            videoToDelete(value) {
                if (value) {
                    this.dialogDelete = true;
                } else {
                    this.dialogDelete = false;
                }
            }
        },
        computed: {
            filteredVideos() {
                return this.videos.filter(video => {
                    return video.title.toLowerCase().includes(this.search.toLowerCase());
                })
            }
        }
    }
</script>

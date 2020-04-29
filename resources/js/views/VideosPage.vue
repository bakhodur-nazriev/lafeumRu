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

        <!-- Add Item Dialog -->
        <v-dialog v-model="dialogAdd" width="700px">
            <v-card>
                <v-form ref="createForm" @submit="addVideo">
                    <v-card-title class="primary white--text mb-5">
                        Создать Видео
                    </v-card-title>
                    <v-card-text>
                        <v-text-field
                            label="Введите название"
                            v-model="newVideo.title"
                            outlined
                            :rules="requiredField"
                        />
                        <v-select
                            label="Выберите канал"
                            v-model="newVideo.channel_id"
                            item-text="name"
                            item-value="id"
                            outlined
                            :items="channels"
                            :rules="requiredField"
                        />
                        <v-select
                            v-model="newVideo.categories"
                            :items="categories"
                            outlined
                            multiple
                            item-value="id"
                            item-text="name"
                            label="Выберите категории"
                            :rules="requiredField"
                        />
                        <v-text-field
                            label="Добавьте ссылку"
                            v-model="newVideo.link"
                            outlined
                            :rules="requiredField"
                        />
                        <v-text-field
                            label="Добавьте продолжительность (в мин.)"
                            type="number"
                            v-model="newVideo.duration"
                            outlined
                            :rules="requiredField"
                        />
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer />
                        <v-btn dark color="green" type="submit"
                            >Сохранить</v-btn
                        >
                        <v-btn
                            dark
                            color="error"
                            type="button"
                            @click="() => (dialogAdd = false)"
                            >Отмена</v-btn
                        >
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>
        <!-- Delete Item Dialog -->
        <v-dialog v-if="videoToDelete" v-model="videoToDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center">
                    Вы действительно хотите удалить это видео ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn
                        color="green darken-1"
                        dark
                        @click="videoToDelete = null"
                    >
                        Нет
                    </v-btn>
                    <v-btn color="red darken-1" dark @click="deleteVideo()"
                        >Да</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Update Item Dialog -->
        <v-dialog v-if="videoToUpdate" v-model="videoToUpdate" width="700px">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить Видео
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-text-field
                                hide-details
                                outlined
                                v-model="videoToUpdate.title"
                                label="Изменить названия видео здесь"
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-select
                                hide-details
                                outlined
                                :items="channels"
                                item-value="id"
                                item-text="name"
                                v-model="videoToUpdate.channel_id"
                                label="Изменить канал видео здесь"
                            >
                            </v-select>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                hide-details
                                outlined
                                v-model="videoToUpdate.link"
                                label="Изменить ссылку видео здесь"
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                hide-details
                                outlined
                                v-model="videoToUpdate.duration"
                                label="Изменить продолжителность видео в минутах здесь"
                            >
                            </v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer />
                    <v-btn dark color="green" @click="updateVideo()"
                        >Сохранить</v-btn
                    >
                    <v-btn dark color="error" @click="videoToUpdate = false"
                        >Отмена</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-content>
</template>

<script>
export default {
    data() {
        return {
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
    beforeMount() {
        this.newVideo = this.getDefaultVideo();
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
        getDefaultVideo() {
            return {
                title: "",
                link: "",
                duration: "",
                channel_id: null,
                categories: []
            };
        },
        resetNewVideoForm() {
            this.dialogAdd = false;
            this.newVideo = this.getDefaultVideo();
        },
        addVideo(e) {
            e.preventDefault();

            const validForm = this.$refs.createForm.validate();

            if(!validForm) return;

            axios
                .post("/api/videos", this.newVideo)
                .then(res => {
                    this.resetNewVideoForm();
                    this.loadVideos();
                })
                .catch(err => {
                    console.log(err);
                });
        },
        updateVideo() {
            axios
                .put("/api/videos/" + this.videoToUpdate.id, {
                    title: this.videoToUpdate.title,
                    channel_id: this.videoToUpdate.channel_id,
                    link: this.videoToUpdate.link,
                    duration: this.videoToUpdate.duration
                })
                .then(res => {
                    this.videoToUpdate = false;
                    this.loadVideos();
                })
                .catch(err => {
                    console.log(err);
                });
        },
        deleteVideo() {
            axios
                .delete("/api/videos/" + this.videoToDelete.id)
                .then(res => {
                    this.videoToDelete = false;
                    this.loadVideos();
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        filteredVideos() {
            return this.videos.filter(video => {
                return video.title
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
        requiredField() {
            return [
                v => {
                    if (Array.isArray(v) && v.length == 0) {
                        return "Обязательное поле";
                    }

                    if (!v) {
                        return "Обязательное поле";
                    }

                    return true;
                }
            ];
        }
    }
};
</script>

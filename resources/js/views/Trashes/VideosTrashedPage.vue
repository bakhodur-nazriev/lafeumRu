<template>
    <v-main class="pa-0">
        <index-page-layout
            no-actions
            ref="indexPage"
            search-field="title"
            :categories="categories"
            :table-headers="this.headers"
            index-url="/api/videos-trashed"
        >
            <template v-slot:item.duration="{ item }">
                <p v-html="item.duration + ' мин'"></p>
            </template>
            <template v-slot:item.link="{ item }">
                <a :href="item.link" target="_blank">{{ item.link }}</a>
            </template>
            <template v-slot:item.categories="{ item }">
                <div
                    v-for="(category, i) in item.categories"
                    :key="i"
                >
                    {{ category.name }},
                </div>
            </template>
            <template v-slot:item.action="{ item }">
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-btn
                            fab
                            dark
                            small
                            v-on="on"
                            elevation="2"
                            color="green"
                            @click="videoToRestore = true"
                        >
                            <v-icon dark>mdi-arrow-left</v-icon>
                        </v-btn>
                    </template>
                    <span>Востановить</span>
                </v-tooltip>
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-btn
                            fab
                            dark
                            small
                            v-on="on"
                            elevation="2"
                            color="red"
                            @click="videoToForceDelete = true"
                        >
                            <v-icon dark>mdi-delete</v-icon>
                        </v-btn>
                    </template>
                    <span>Удалить безвазвратно</span>
                </v-tooltip>
            </template>
        </index-page-layout>

        <v-dialog v-model="showRestoreDialog" width="480">
            <v-card v-if="showRestoreDialog" class="pa-2">
                <v-card-title class="font-weight-regular headline text-center pa-2">
                    Вы действительно хотите востановить цитату ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn dark color="green" @click="videoToRestore = null">Нет</v-btn>
                    <v-btn dark color="red" @click="restoreVideo()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog v-model="showForceDeleteDialog" width="500">
            <v-card v-if="showForceDeleteDialog" class="pa-2">
                <v-card-title class="font-weight-regular headline text-center pa-2">
                    Вы действительно хотите безвозвратно удалить эту цитату ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn dark color="green" @click="videoToForceDelete = null">Нет</v-btn>
                    <v-btn dark color="red" @click="forceDeleteVideo()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-main>
</template>

<script>
import IndexPageLayout from "../../components/IndexPageLayout";

export default {
    components: {IndexPageLayout},
    data() {
        return {
            channels: [],
            categories: [],
            addVideo: false,
            videoToRestore: null,
            videoToForceDelete: null,
            headers: [
                {
                    text: "Названия",
                    value: "title"
                },
                {
                    text: "Каналы",
                    value: "channel.name"
                },
                {
                    text: "Ссылки",
                    value: "link"
                },
                {
                    text: "Рубрики",
                    value: "categories",
                    align: "center"
                },
                {
                    text: "Опубликовано",
                    value: "publish_at",
                    width: 160
                },
                {
                    text: "Время",
                    value: "duration",
                    align: "center"
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
        this.loadCategories();
    },
    methods: {
        loadChannels() {
            axios
                .get("/api/channels/?no_pagination")
                .then(res => (this.channels = res.data))
                .catch(e => console.log(e))
        },
        loadCategories() {
            axios
                .get("/api/categories?type=" + VIDEO_TYPE)
                .then(res => (this.categories = res.data))
                .catch(e => console.log(e));
        },
        restoreVideo() {
            axios
                .put("/api/video-trashed/" + this.videoToRestore.id)
                .then(res => (this.videoToRestore = false))
                .catch(err => console.log(err))
        },
        forceDeleteVideo() {
            axios
                .delete("/api/video-trashed/" + this.videoToForceDelete.id)
                .then(res => (this.videoToForceDelete = false))
                .catch(err => console.log(err))
        }
    },
    computed: {
        showRestoreDialog: {
            get() {
                return this.videoToRestore;
            },
            set(v) {
                if (!v) {
                    this.videoToRestore = null;
                }
            }
        },
        showForceDeleteDialog: {
            get() {
                return this.videoToForceDelete;
            },
            set(v) {
                if (!v) {
                    this.videoToForceDelete = null;
                }
            }
        }
    },
}
</script>

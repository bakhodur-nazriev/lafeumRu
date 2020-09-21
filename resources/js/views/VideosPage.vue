<template>
    <v-main class="pa-0">
        <index-page-layout
            index-url="/api/videos"
            :categories="categories"
            :table-headers="this.headers"
            add-label="Добавить видео"
            searchField="title"
            ref="indexPage"
            @show-item="showVideo"
            @add-item="addVideo = true"
            @update-item="videoToUpdate = $event"
            @delete-item="videoToDelete = $event"
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
        </index-page-layout>

        <videos-create-dialog
            v-model="addVideo"
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
    </v-main>
</template>

<script>
import rules from "../validation-rules";

import IndexPageLayout from "../components/IndexPageLayout";
import VideosCreateDialog from "./VideosCreateDialog";
import VideosEditDialog from "./VideosEditDialog";
import VideosDeleteDialog from "./VideosDeleteDialog";
import VideosShowDialog from "./VideosShowDialog";

export default {
    components: {
        IndexPageLayout,
        VideosCreateDialog,
        VideosEditDialog,
        VideosDeleteDialog,
    },
    data() {
        return {
            rules,
            addVideo: false,
            videoToDelete: null,
            videoToUpdate: null,
            channels: [],
            categories: [],
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
                }
            ]
        };
    },
    mounted() {
        this.loadChannels();
        this.loadVideoCategories();
    },
    methods: {
        loadChannels() {
            axios
                .get("/api/channels/?no_pagination")
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
            this.addVideo = false;
            this.$refs.indexPage.loadItems();
        },
        videoUpdated(updated) {
            this.videoToUpdate = null;
            this.$refs.indexPage.loadItems();
        },
        videoDeleted() {
            this.videoToDelete = null;
            this.$refs.indexPage.loadItems();
        },
        showVideo(video) {
            window.open('/' + video.post.id, '_blank');
        },
    }
};
</script>

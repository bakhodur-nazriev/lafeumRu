<template>
    <v-content class="pa-0">
        <index-page-layout
            index-url="/api/videos"
            :table-headers="this.headers"
            add-label="Добавить видео"
            searchField="title"
            ref="indexPage"
            @add-item="dialogAdd = true"
            @update-item="videoToUpdate = $event"
            @delete-item="videoToDelete = $event"
        >
            <template v-slot:item.duration="{ item }">
                <p v-html="item.duration + ' мин'"></p>
            </template>
            <template v-slot:item.link="{ item }">
                <a :href="item.link" target="_blank">{{ item.link }}</a>
            </template>
        </index-page-layout>

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

        <videos-delete-dialog v-model="videoToDelete" @deleted="videoDeleted" />
    </v-content>
</template>

<script>
import rules from "../validation-rules";

import IndexPageLayout from "../components/IndexPageLayout";
import VideosCreateDialog from "./VideosCreateDialog";
import VideosEditDialog from "./VideosEditDialog";
import VideosDeleteDialog from "./VideosDeleteDialog";

export default {
    components: {
        IndexPageLayout,
        VideosCreateDialog,
        VideosEditDialog,
        VideosDeleteDialog
    },
    data() {
        return {
            rules,
            dialogAdd: false,
            videoToDelete: null,
            videoToUpdate: null,
            channels: [],
            categories: [],
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
            this.$refs.indexPage.loadItems();
        },
        videoUpdated(updated) {
            this.videoToUpdate = null;
            this.$refs.indexPage.loadItems();
        },
        videoDeleted() {
            this.videoToDelete = null;
            this.$refs.indexPage.loadItems();
        }
    }
};
</script>

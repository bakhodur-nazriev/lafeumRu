<template>
    <v-main class="pa-0">
        <index-page-layout
            ref="indexPage"
            search-field="title"
            :categories="categories"
            :table-headers="this.headers"
            index-url="/api/videos-trashed"
            @restore-item="videoToRestore = $event"
            @force-delete-item="videoToForceDelete = $event"
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

        <videos-reverse-dialog
            v-model="videoToRestore"
            @restored="videoRestored"
        />
        <videos-force-delete-dialog
            v-model="videoToForceDelete"
            @force-deleted="videoForceDeleted"
        />
    </v-main>
</template>

<script>
import IndexPageLayout from "../../components/IndexPageLayout";
import VideosForceDeleteDialog from "./VideosForceDeleteDialog";
import VideosReverseDialog from "./VideosRestoreDialog";

export default {
    components: {
        IndexPageLayout,
        VideosReverseDialog,
        VideosForceDeleteDialog
    },
    data() {
        return {
            channels: [],
            categories: [],
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
                }
            ]
        };
    },
    mounted() {
        this.loadChannels();
        this.loadCategories();
    },
    methods: {
        videoRestored() {
            this.videoToRestore = null;
            this.$refs.indexPage.loadItems();
        },
        videoForceDeleted() {
            this.videoForceDelete = null;
            this.$refs.indexPage.loadItems();
        },
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
        }
    }
}
</script>

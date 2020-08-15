<template>
    <v-content class="pa-0">
        <index-page-layout
            index-url="/api/videos"
            :table-headers="this.headers"
            add-label="Добавить видео"
            searchField="title"
            ref="indexPage"
            @click:item="videoClick"
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
                    {{category.name}},
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

        <videos-show-dialog
            :video="videoToShow"
            :categories="categories"
            @close="videoToShow = null"
        />

        <videos-delete-dialog
            v-model="videoToDelete"
            @deleted="videoDeleted"
        />
    </v-content>
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
            VideosShowDialog
        },
        data() {
            return {
                rules,
                addVideo: false,
                videoToShow: null,
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
                        text: "Дата добавления",
                        value: "created_at",
                        align: "center"
                    },
                    {
                        text: "Дата изменения",
                        value: "updated_at",
                        align: "center"
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
                    .get("/api/channels")
                    .then(res => {
                        this.channels = res.data.channels.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            loadVideoCategories() {
                axios
                    .get("/api/categories?type=" + VIDEO_TYPE)
                    .then(res => (this.categories = res.data.channels.data))
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
            videoClick(video) {
                this.videoToShow = video;
            },
        }
    };
</script>

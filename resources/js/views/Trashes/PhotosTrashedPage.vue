<template>
    <main class="pa-0">
        <index-page-layout
            ref="indexPage"
            index-url="/api/photos-trashed"
            search-field="description"
            :table-headers="this.headers"
            @restore-item="photoToRestore = $event"
            @force-delete-item="photoToForceDelete = $event"
        >
            <template v-slot:item.image="{item}">
                <div class="text-center pa-2">
                    <v-img
                        :src="item.path"
                        :alt="item.description"
                        max-width="6rem"
                    />
                </div>
            </template>
        </index-page-layout>

        <photos-reverse-dialog
            v-model="photoToRestore"
            @restored="photoRestored"
        />

        <photos-force-delete-dialog
            v-model="photoToForceDelete"
            @force-deleted="photoForceDeleted"
        />
    </main>
</template>

<script>
import IndexPageLayout from "../../components/IndexPageLayout";
import PhotosForceDeleteDialog from "./PhotosForceDeleteDialog";
import PhotosReverseDialog from "./PhotosRestoreDialog";

export default {
    components: {
        IndexPageLayout,
        PhotosReverseDialog,
        PhotosForceDeleteDialog
    },
    data() {
        return {
            photoToRestore: null,
            photoToForceDelete: null,
            headers: [
                {
                    text: "Фото",
                    width: "150px",
                    value: "image",
                    align: "center",
                    sortable: false,
                    class: "mine-table-headers"
                },
                {
                    text: "Описание",
                    value: "description"
                },
                {
                    text: "Опубликовано",
                    value: "publish_at",
                    width: 160
                }
            ]
        }
    },
    methods: {
        photoRestored() {
            this.photoToRestore = null;
            this.$refs.indexPage.loadItems();
        },
        photoForceDeleted() {
            this.photoToForceDelete = null;
            this.$refs.indexPage.loadItems();
        }
    }
}
</script>

<template>
    <v-main class="pa-0">
        <index-page-layout
            index-url="/api/photos"
            :table-headers="this.headers"
            add-label="Добавить фото"
            searchField="description"
            ref="indexPage"
            @show-item="showPhoto"
            @add-item="addPhoto = true"
            @update-item="photoToUpdate = $event"
            @delete-item="photoToDelete = $event"
        >
            <template v-slot:item.image="{ item }">
                <div class="text-center pa-2">
                    <v-img
                        :src="item.path"
                        :alt="item.description"
                        max-width="6rem"
                    />
                </div>
            </template>
        </index-page-layout>

        <photo-create-dialog
            v-model="addPhoto"
            @created="photoCreated"
        />

        <photo-edit-dialog
            v-model="photoToUpdate"
            @updated="photoUpdated"
        />

        <photo-show-dialog
            :photo="photoToShow"
            @close="photoToShow = null"
        />

        <photo-delete-dialog
            v-model="photoToDelete"
            @deleted="photoDeleted"
        />

    </v-main>
</template>
<script>
    import IndexPageLayout from "../components/IndexPageLayout";
    import PhotoCreateDialog from "./PhotoCreateDialog";
    import PhotoEditDialog from "./PhotoEditDialog";
    import PhotoShowDialog from "./PhotoShowDialog";
    import PhotoDeleteDialog from "./PhotoDeleteDialog";

    export default {
        components: {
            IndexPageLayout,
            PhotoCreateDialog,
            PhotoEditDialog,
            PhotoShowDialog,
            PhotoDeleteDialog
        },
        data() {
            return {
                addPhoto: false,
                photoToShow: null,
                photoToDelete: null,
                photoToUpdate: null,
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
            };
        },
        methods: {
            photoCreated(newPhoto) {
                this.addPhoto = false;
                this.$refs.indexPage.loadItems();
            },
            photoUpdated(updated) {
                this.photoToUpdate = null;
                this.$refs.indexPage.loadItems();
            },
            photoDeleted() {
                this.photoToDelete = null;
                this.$refs.indexPage.loadItems();
            },
            showPhoto(photo) {
                this.photoToShow = photo;
            },
        }
    };
</script>

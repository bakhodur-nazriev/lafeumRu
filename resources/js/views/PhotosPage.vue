<template>
    <v-content class="pa-0">
        <index-page-layout
            index-url="/api/photos"
            :table-headers="this.headers"
            add-label="Добавить фото"
            searchField="description"
            ref="indexPage"
            @click:item="photoClick"
            @add-item="dialogAdd = true"
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

        <photo-delete-dialog
            v-model="photoToDelete"
            @deleted="photoDeleted"
        />

        <photo-show-dialog
            :photo="photoToShow"
            @close="photoToShow = null"
        />

    </v-content>
</template>
<script>
    import IndexPageLayout from "../components/IndexPageLayout";
    import PhotoShowDialog from "./PhotoShowDialog";
    import PhotoEditDialog from "./PhotoEditDialog";
    import PhotoDeleteDialog from "./PhotoDeleteDialog";
    import PhotoCreateDialog from "./PhotoCreateDialog";

    export default {
        components: {
            PhotoCreateDialog,
            PhotoShowDialog,
            PhotoEditDialog,
            PhotoDeleteDialog,
            IndexPageLayout
        },
        data() {
            return {
                dialogAdd: false,
                photoImage: [],
                photoDescription: "",
                photoCreatedAtDate: null,
                photoToShow: null,
                photoToDelete: null,
                photoToUpdate: null,
                headers: [
                    {
                        text: "Фото",
                        value: "image",
                        sortable: false,
                        class: "mine-table-headers",
                        width: "150px",
                        align: "center"
                    },
                    {
                        text: "Описание",
                        value: "description",
                        sortable: false
                    },
                    {
                        text: "Дата добавления",
                        value: "created_at",
                        align: "center",
                        sortable: false
                    },
                    {
                        text: "Дата изменения",
                        value: "updated_at",
                        align: "center",
                        sortable: false
                    }
                ]
            };
        },
        methods: {
            photoCreated(newPhoto) {
                this.addPhoto = false;
                this.$refs.indexPage.loadItems();
            },
            photoUpdated(newPhoto) {
                this.photoToUpdate = null;
                this.$refs.indexPage.loadItems();
            },
            photoDeleted(newPhoto) {
                this.photoToDelete = null;
                this.$refs.indexPage.loadItems();
            },
            photoClick(photo) {
                this.photoToShow = photo;
            },
        }
    };
</script>

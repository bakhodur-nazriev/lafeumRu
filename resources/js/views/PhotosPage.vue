<template>
    <v-content class="pa-0">
        <index-page-layout
            index-url="/api/photos"
            :table-headers="this.headers"
            add-label="Добавить фото"
            searchField="description"
            ref="indexPage"
            @click:item="photoClick"
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

        <!--<photo-edit-dialog
            v-model="photoToUpdate"
            @updated="photoUpdated"
        />-->


        <photo-show-dialog
            :photo="photoToShow"
            @close="photoToShow = null"
        />

        <photo-delete-dialog
            v-model="photoToDelete"
            @deleted="photoDeleted"
        />

    </v-content>
</template>
<script>
    import rules from "../validation-rules";
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
                rules,
                addPhoto: false,
                /*photoImage: [],
                photoDescription: "",*/
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

<template>
    <main class="pa-0">
        <index-page-layout
            ref="indexPage"
            index-url="/api/photos-trashes"
            search-field="description"
            :table-headers="this.headers"
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

        <photos-reverse-dialog/>
        <photos-force-delete-dialog/>
    </main>
</template>

<script>
import IndexPageLayout from "../../components/IndexPageLayout";
import PhotosForceDeleteDialog from "./PhotosForceDeleteDialog";
import PhotosReverseDialog from "./PhotosReverseDialog";

export default {
    components: {PhotosReverseDialog, PhotosForceDeleteDialog, IndexPageLayout},
    data() {
        return {
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
    }
}
</script>

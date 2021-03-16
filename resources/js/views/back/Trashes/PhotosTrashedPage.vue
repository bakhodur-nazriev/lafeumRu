<template>
    <main class="pa-0">
        <index-page-layout
            no-actions
            ref="indexPage"
            search-field="description"
            index-url="/api/photos-trashed"
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
                            @click="photoToRestore = { ...item }"
                        >
                            <v-icon dark>mdi-arrow-left</v-icon>
                        </v-btn>
                    </template>
                    <span>Восстановить</span>
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
                            @click="photoToForceDelete = { ...item }"
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
                    Вы действительно хотите восстановить фото ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn dark color="red" @click="photoToRestore = null">Нет</v-btn>
                    <v-btn dark color="green" @click="restorePhoto()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog v-model="showForceDeleteDialog" width="500">
            <v-card v-if="showForceDeleteDialog" class="pa-2">
                <v-card-title class="font-weight-regular headline text-center pa-2">
                    Вы действительно хотите безвозвратно удалить фото ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn dark color="green" @click="photoToForceDelete = null">Нет</v-btn>
                    <v-btn dark color="red" @click="forceDeletePhoto()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </main>
</template>

<script>
import IndexPageLayout from "../../../components/IndexPageLayout";

export default {
    components: {IndexPageLayout},
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
                },
                {
                    text: "Действия",
                    value: "action",
                    align: "center",
                    sortable: false,
                    width: "160px"
                }
            ]
        }
    },
    methods: {
        restorePhoto() {
            axios
                .put("/api/photo-trashed/" + this.photoToRestore.id)
                .then(res => {
                    this.photoToRestore = false;
                    this.$refs.indexPage.loadItems();
                })
                .catch(err => console.log(err))
        },
        forceDeletePhoto() {
            axios
                .delete("/api/photo-trashed/" + this.photoToForceDelete.id)
                .then(res => {
                    this.photoToForceDelete = false;
                    this.$refs.indexPage.loadItems();
                })
                .catch(err => console.log(err))
        }
    },

    computed: {
        showRestoreDialog: {
            get() {
                return this.photoToRestore;
            },
            set(v) {
                if (!v) {
                    this.photoToRestore = null;
                }
            }
        },

        showForceDeleteDialog: {
            get() {
                return this.photoToForceDelete;
            },
            set(v) {
                if (!v) {
                    this.photoToForceDelete = null;
                }
            }
        }
    }
}
</script>

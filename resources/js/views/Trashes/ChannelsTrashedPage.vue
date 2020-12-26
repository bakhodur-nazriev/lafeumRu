<template>
    <v-main class="pa-0">
        <index-page-layout
            no-actions
            ref="indexPage"
            search-field="name"
            index-url="/api/channels-trashed"
            :table-headers="this.headers"
        >
            <template v-slot:item.description="{ item }">
                <div
                    v-html="item.description"
                    class="my-3 three-line-truncate"
                />
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
                            @click="channelToRestore = true"
                        >
                            <v-icon dark>mdi-arrow-left</v-icon>
                        </v-btn>
                    </template>
                    <span>Востановить</span>
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
                            @click="channelToForceDelete = true"
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
                    Вы действительно хотите востановить канал ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn dark color="green" @click="channelToRestore = null">Нет</v-btn>
                    <v-btn dark color="red" @click="restoreChannel()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog v-model="showForceDeleteDialog" width="500">
            <v-card v-if="showForceDeleteDialog" class="pa-2">
                <v-card-title class="font-weight-regular headline text-center pa-2">
                    Вы действительно хотите безвозвратно удалить канал ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn dark color="green" @click="channelToForceDelete = null">Нет</v-btn>
                    <v-btn dark color="red" @click="forceDeleteChannel()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-main>
</template>

<script>
import IndexPageLayout from "../../components/IndexPageLayout";

export default {
    components: {IndexPageLayout},
    data() {
        return {
            channelToRestore: null,
            channelToForceDelete: null,
            headers: [
                {
                    text: "Название",
                    value: "name",
                    sortable: false
                },
                {
                    text: "Описание",
                    value: "description",
                    sortable: false
                },
                {
                    text: "Действия",
                    value: "action",
                    align: "center",
                    sortable: false,
                    width: "160px"
                }
            ]
        };
    },
    methods: {
        restoreChannel() {
            axios
                .put("/api/channel-trashed/" + this.channelToRestore.id)
                .then(res => (this.channelToRestore = false))
                .catch(err => console.log(err))
        },
        forceDeleteChannel() {
            axios
                .delete("/api/channel-trashed/" + this.channelToForceDelete.id)
                .then(res => (this.channelToForceDelete = false))
                .catch(err => console.log(err))
        }
    },
    computed: {
        showRestoreDialog: {
            get() {
                return this.channelToRestore;
            },
            set(v) {
                if (!v) {
                    this.channelToRestore = null;
                }
            }
        },
        showForceDeleteDialog: {
            get() {
                return this.channelToForceDelete;
            },
            set(v) {
                if (!v) {
                    this.channelToForceDelete = null;
                }
            }
        }
    },
}
</script>

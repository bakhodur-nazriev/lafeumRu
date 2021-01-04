<template>
    <v-main class="pa-0">
        <index-page-layout
            ref="indexPage"
            index-url="/api/channels"
            search-field="name"
            add-label="Добавить канал"
            :table-headers="this.headers"
            @show-item="channelShow"
            @add-item="addChannel = true"
            @update-item="channelToUpdate = $event"
            @delete-item="channelToDelete = $event"
        >
            <template v-slot:item.description="{ item }">
                <div
                    v-html="item.description"
                    class="my-3 three-line-truncate"
                />
            </template>
        </index-page-layout>

        <channels-create-dialog
            v-model="addChannel"
            @created="channelCreated"
        />

        <channels-edit-dialog
            v-model="channelToUpdate"
            @updated="channelUpdated"
        />

        <channels-delete-dialog
            v-model="channelToDelete"
            @deleted="channelDeleted"
        />
    </v-main>
</template>

<script>
import IndexPageLayout from "../../components/IndexPageLayout";
import ChannelsCreateDialog from "./ChannelsCreateDialog";
import ChannelsEditDialog from "./ChannelsEditDialog";
import ChannelsDeleteDialog from "./ChannelsDeleteDialog";

export default {
    components: {
        IndexPageLayout,
        ChannelsCreateDialog,
        ChannelsEditDialog,
        ChannelsDeleteDialog,
    },
    data() {
        return {
            addChannel: false,
            channelToDelete: null,
            channelToUpdate: null,
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
                }
            ]
        };
    },
    methods: {
        channelCreated(newChannel) {
            this.addChannel = false;
            this.$refs.indexPage.loadItems();
        },
        channelUpdated(updated) {
            this.channelToUpdate = null;
            this.$refs.indexPage.loadItems();
        },
        channelDeleted() {
            this.channelToDelete = null;
            this.$refs.indexPage.loadItems();
        },
        channelShow(channel) {
            window.open('/channels/' + channel.slug, '_blank');
        }
    },
}
</script>

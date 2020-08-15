<template>
    <v-content class="pa-0">
        <index-page-layout
            ref="indexPage"
            index-url="/api/channels"
            search-field="name"
            add-label="Добавить канал"
            :table-headers="this.headers"
            @click:item="channelClick"
            @add-item="addChannel = true"
            @update-item="channelToUpdate = $event"
            @delete-item="channelToDelete = $event"
        >
        </index-page-layout>

        <channels-create-dialog
            v-model="addChannel"
            @created="channelCreated"
        />

        <channels-edit-dialog
            v-model="channelToUpdate"
            @updated="channelUpdated"
        />

        <channels-show-dialog
            :channel="channelToShow"
            @close="channelToShow = null"
        />

        <channels-delete-dialog
            v-model="channelToDelete"
            @deleted="channelDeleted"
        />
    </v-content>
</template>

<script>
    import IndexPageLayout from "../components/IndexPageLayout";
    import ChannelsCreateDialog from "./ChannelsCreateDialog";
    import ChannelsEditDialog from "./ChannelsEditDialog";
    import ChannelsDeleteDialog from "./ChannelsDeleteDialog";
    import ChannelsShowDialog from "./ChannelsShowDialog";

    export default {
        components: {
            IndexPageLayout,
            ChannelsShowDialog,
            ChannelsCreateDialog,
            ChannelsEditDialog,
            ChannelsDeleteDialog
        },
        data() {
            return {
                addChannel: false,
                channelToDelete: null,
                channelToUpdate: null,
                channelToShow: null,
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
            channelClick(channel) {
                this.channelToShow = channel;
            }
        },
    }
</script>

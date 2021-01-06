<template>
    <v-dialog v-if="channelToDelete" v-model="channelToDelete" width="460">
        <v-card class="pa-2">
            <v-card-title class="font-weight-regular headline text-center pa-2">
                Вы действительно хотите отправить канал в карзину ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn dark color="green" @click="$emit('input', null)">Нет</v-btn>
                <v-btn dark color="red" @click="deleteChannel()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {value: Object},
    methods: {
        deleteChannel() {
            axios
                .delete("/api/channels/" + this.channelToDelete.slug)
                .then(res => (this.$emit('deleted')))
                .catch(err => (console.log(err)))
        }
    },
    computed: {
        channelToDelete: {
            get() {
                return this.value;
            },
            set(v) {
                if (!v) {
                    this.$emit("input", null);
                }
            }
        }
    }
};
</script>

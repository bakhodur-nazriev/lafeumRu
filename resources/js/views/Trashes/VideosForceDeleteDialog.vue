<template>
    <v-dialog v-if="videoToForceDelete" v-model="videoToForceDelete" width="500">
        <v-card class="pa-2">
            <v-card-title class="font-weight-regular headline text-center pa-2">
                Вы действительно хотите безвозвратно удалить эту видео ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn dark color="green" @click="videoToForceDelete = null">Нет</v-btn>
                <v-btn dark color="red" @click="forceDeleteVideo()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {value: Object},
    methods: {
        forceDeleteVideo() {
            axios
                .delete("/api/videos-trashed/" + this.videoToForceDelete.id)
                .then(res => (this.$emit('force-deleted')))
                .catch(err => (console.log(err)))
        }
    },
    computed: {
        videoToForceDelete: {
            get() {
                return this.value;
            },
            set(v) {
                if (!v) {
                    this.$emit('input', null)
                }
            }
        }
    }
}
</script>

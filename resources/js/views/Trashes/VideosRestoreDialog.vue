<template>
    <v-dialog v-if="videoToRestore" v-model="videoToRestore" width="500">
        <v-card class="pa-1">
            <v-card-title class="pt-1 font-weight-regular headline text-center">
                Вы действительно хотите востановить этот видео ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn dark color="green" @click="videoToRestore = null">Нет</v-btn>
                <v-btn dark color="red" @click="restoreVideo()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {value: Object},
    methods: {
        restoreVideo() {
            axios
                .put("/api/videos-trashed/" + this.videoToRestore.id)
                .then(res => (this.$emit('restored')))
                .catch(err => (console.log(err)))
        }
    },
    computed: {
        videoToRestore: {
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

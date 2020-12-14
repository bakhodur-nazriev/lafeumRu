<template>
    <v-dialog v-if="photoToForceDelete" v-model="photoToForceDelete" width="500">
        <v-card class="pa-2">
            <v-card-title class="font-weight-regular headline text-center pa-2">
                Вы действительно хотите безвозвратно удалить эту фото ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn dark color="green" @click="photoToForceDelete = null">Нет</v-btn>
                <v-btn dark color="red" @click="forceDeletePhoto()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {value: Object},
    methods: {
        forceDeletePhoto() {
            axios
                .delete("/api/photos-trashed/" + this.photoToForceDelete)
                .then(res => (this.$emit("force-deleted")))
                .catch(err => (console.log(err)))
        }
    },
    created() {
        this.photoToForceDelete
    },
    computed: {
        photoToForceDelete: {
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

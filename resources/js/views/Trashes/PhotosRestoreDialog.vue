<template>
    <v-dialog v-if="photoToRestore" v-model="photoToRestore" width="500">
        <v-card class="pa-1">
            <v-card-title class="pt-1 font-weight-regular headline text-center">
                Вы действительно хотите востановить фото ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn dark color="green" @click="photoToRestore = null">Нет</v-btn>
                <v-btn dark color="red" @click="restorePhoto()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {value: Object},
    methods: {
        restorePhoto() {
            axios
                .delete("/api/photos-trashed/" + this.restorePhoto.id)
                .then(res => (this.$emit('restored')))
                .catch(err => (console.log(err)))
        }
    },
    computed: {
        photoToRestore: {
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

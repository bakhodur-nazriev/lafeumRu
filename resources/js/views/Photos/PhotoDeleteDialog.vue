<template>
    <v-dialog v-if="photoToDelete" v-model="photoToDelete" width="460">
        <v-card class="pa-2">
            <v-card-title class="font-weight-regular headline text-center pa-2">
                Вы действительно хотите отправить фото в корзину ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn dark color="green" @click="photoToDelete = null">Нет</v-btn>
                <v-btn dark color="red" @click="deletePhoto()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {value: Object},
    methods: {
        deletePhoto() {
            axios
                .delete("/api/photos/" + this.photoToDelete.id)
                .then(res => (this.$emit("deleted")))
                .catch(err => (console.log(err)))
        }
    },
    computed: {
        photoToDelete: {
            get() {
                return this.value;
            },
            set(v) {
                if (!v) {
                    this.$emit('input', null)
                }
            }
        }
    },
}
</script>

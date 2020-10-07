<template>
    <v-dialog v-if="photoToDelete" v-model="photoToDelete" width="430">
        <v-card class="pa-2">
            <v-card-title class="regular headline text-center pa-2">
                Вы действительно хотите удалить это фото ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn color="primary" @click="photoToDelete = false">Нет</v-btn>
                <v-btn color="primary" @click="deletePhoto()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        props: {
            value: Object
        },
        methods: {
            deletePhoto() {
                axios
                    .delete("/api/photos/" + this.photoToDelete.id)
                    .then(res => {
                        this.$emit('deleted');
                    })
                    .catch(err => {
                        console.log(err);
                    });
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

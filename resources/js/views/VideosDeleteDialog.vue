<template>
    <v-dialog v-if="videoToDelete" v-model="videoToDelete" width="520">
        <v-card class="pa-2">
            <v-card-title class="pt-1 regular headline text-center">
                Вы действительно хотите удалить это видео ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn color="primary" @click="$emit('input', null)">Нет</v-btn>
                <v-btn color="primary" @click="deleteVideo()">Да</v-btn>
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
        deleteVideo() {
            axios
                .delete("/api/videos/" + this.videoToDelete.id)
                .then(res => {
                    this.$emit('deleted')
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        videoToDelete: {
            get(){
                return this.value;
            },
            set(v){
                if(!v){
                    this.$emit('input', null);
                }
            }
        }
    }
};
</script>

<template>
    <v-dialog v-if="termToDelete" v-model="termToDelete" width="500">
        <v-card class="pa-2">
            <v-card-title class="pt-1 regular headline text-center"
                >Вы действительно хотите удалить это термин ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn color="primary" dark @click="termToDelete = false">Нет</v-btn>
                <v-btn color="primary" dark @click="deleteTerm()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props:{
        value: Object
    },
    methods: {
        deleteTerm() {
            axios
                .delete("/api/terms/" + this.termToDelete.id)
                .then(res => {
                    this.$emit('deleted');
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        termToDelete: {
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

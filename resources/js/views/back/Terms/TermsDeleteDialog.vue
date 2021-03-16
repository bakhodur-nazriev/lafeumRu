<template>
    <v-dialog v-if="termToDelete" v-model="termToDelete" width="480">
        <v-card class="pa-2">
            <v-card-title class="font-weight-regular headline text-center pt-2">
                Вы действительно хотите отправить термин в корзину ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn dark color="green" @click="termToDelete = false">Нет</v-btn>
                <v-btn dark color="red" @click="deleteTerm()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {value: Object},
    methods: {
        deleteTerm() {
            axios
                .delete("/api/terms/" + this.termToDelete.id)
                .then(res => (this.$emit('deleted')))
                .catch(err => (console.log(err)))
        }
    },
    computed: {
        termToDelete: {
            get() {
                return this.value;
            },
            set(v) {
                if (!v) {
                    this.$emit('input', null);
                }
            }
        }
    }
};
</script>

<template>
    <v-dialog v-if="quoteToDelete" v-model="quoteToDelete" width="460">
        <v-card class="pa-2">
            <v-card-title class="font-weight-medium headline text-center pa-2">
                Вы действительно хотите отправить цитату в корзину?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn color="primary" @click="quoteToDelete = null">Нет</v-btn>
                <v-btn color="primary" @click="deleteQuote()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {value: Object},
    methods: {
        deleteQuote() {
            axios
                .delete("/api/quotes/" + this.quoteToDelete.id)
                .then(res => (this.$emit('deleted')))
                .catch(err => (console.log(err)))
        }
    },
    computed: {
        quoteToDelete: {
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

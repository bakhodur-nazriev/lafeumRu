<template>
    <v-dialog v-if="quoteToForceDelete" v-model="quoteToForceDelete" width="500">
        <v-card class="pa-2">
            <v-card-title class="regular headline text-center pa-2">
                Вы действительно хотите безвозвратно удалить эту цитату ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn dark color="green" @click="quoteToForceDelete = null">Нет</v-btn>
                <v-btn dark color="red" @click="forceDeleteQuote()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {value: Object},
    methods: {
        forceDeleteQuote() {
            axios
                .delete("/api/quotes-trashed/" + this.quoteToForceDelete.id)
                .then(res => (this.$emit('force-deleted')))
                .catch(err => (console.log(err)))
        }
    },
    computed: {
        quoteToForceDelete: {
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

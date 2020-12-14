<template>
    <v-dialog v-if="quoteToRestore" v-model="quoteToRestore" width="500">
        <v-card class="pa-1">
            <v-card-title class="pt-1 font-weight-regular headline text-center">
                Вы действительно хотите востановить цитату ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn dark color="green" @click="quoteToRestore = null">Нет</v-btn>
                <v-btn dark color="red" @click="restoreQuote()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {value: Object},
    methods: {
        restoreQuote() {
            axios
                .put("/api/quotes-trashed/" + this.quoteToRestore.id)
                .then(res => (this.$emit('restored')))
                .catch(err => (console.log(err)))
        }
    },
    computed: {
        quoteToRestore: {
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

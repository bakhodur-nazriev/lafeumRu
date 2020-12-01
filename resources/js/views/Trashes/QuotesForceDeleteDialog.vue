<template>
    <v-dialog v-if="quoteToForceDelete" v-model="quoteToForceDelete" width="500">
        <v-card class="pa-2">
            <p class="pt-1 regular headline text-center">
                Вы действительно хотите безвозвратно удалить эту цитату ?
            </p>
            <v-card-actions class="justify-center">
                <v-btn
                    dark
                    color="green darken-1"
                    @click="$emit('input', null)"
                >
                    Нет
                </v-btn>
                <v-btn color="red darken-1" dark @click="forceDeleteQuote()">
                    Да
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        value: Object
    },
    data() {
        return {}
    },
    methods: {
        forceDeleteQuote() {
            const url = "/api/quotes-trashed" + this.quoteToForceDelete.slug;

            axios
                .delete(url)
                .then(res => (this.$emit('force-deleted', res.data)))
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

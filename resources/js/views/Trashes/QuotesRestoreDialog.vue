<!--
<template>
    <v-dialog v-if="quoteToRestore" v-model="quoteToRestore" width="500">
        <v-card class="pa-2">
            <p class="pt-1 regular headline text-center">
                Вы действительно хотите востановить цитату ?
            </p>
            <v-card-actions class="justify-center">
                <v-btn
                    dark
                    color="green darken-1"
                    @click="$emit('input', null)"
                >
                    Нет
                </v-btn>
                <v-btn color="red darken-1" dark @click="restoreQuote()">
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
        restoreQuote() {
            const url = "/api/quotes-trashed" + this.quoteToRestore.slug;

            axios
            .post()
        }
    }
}
</script>
-->

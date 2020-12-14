<template>
    <v-dialog v-if="termToRestore" v-model="termToRestore" width="500">
        <v-card class="pa-1">
            <v-card-title class="pt-1 font-weight-regular headline text-center">
                Вы действительно хотите востановить этот термин ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn dark color="green" @click="termToRestore = null">Нет</v-btn>
                <v-btn dark color="red" @click="restoreTerm()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {value: Object},
    methods: {
        restoreTerm() {
            axios
                .put("/api/terms-trashed/" + this.termToRestore.id)
                .then(res => (this.$emit('restored')))
                .catch(err => (console.log(err)))
        }
    },
    computed: {
        termToRestore: {
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

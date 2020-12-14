<template>
    <v-dialog v-if="termToForceDelete" v-model="termToForceDelete" width="500">
        <v-card class="pa-2">
            <v-card-title class="font-weight-regular headline text-center pa-2">
                Вы действительно хотите безвозвратно удалить эту термин ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn dark color="green" @click="termToForceDelete = null">Нет</v-btn>
                <v-btn dark color="red" @click="forceDeleteTerm()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {value: Object},
    methods: {
        forceDeleteTerm() {
            axios
                .delete("/api/terms-trashed/" + this.termToForceDelete.id)
                .then(res => (this.$emit('force-deleted')))
                .catch(err => (console.log(err)))
        }
    },
    computed: {
        termToForceDelete: {
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

<template>
    <v-dialog v-if="authorToDelete" v-model="authorToDelete" width="450">
        <v-card class="pa-1">
            <v-card-title class="font-weight-regular headline text-center pa-2">
                Вы действительно хотите отрпавить автора в корзину ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn dark color="primary" @click="$emit('input', null)">Нет</v-btn>
                <v-btn dark color="primary" @click="deleteAuthor()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {value: Object},
    methods: {
        deleteAuthor() {
            const url = "/api/authors/" + this.authorToDelete.slug;

            axios
                .delete(url)
                .then(res => (this.$emit('deleted', res.data)))
                .catch(err => (console.log(err)))
        }
    },
    computed: {
        authorToDelete: {
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

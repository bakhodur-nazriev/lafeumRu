<template>
    <v-dialog
        v-if="knowledgeAreaToDelete"
        v-model="knowledgeAreaToDelete"
        width="500"
    >
        <v-card class="pa-2">
            <v-card-title class="pt-1 regular headline text-center">
                Вы действительно хотите удалить эту область знаний ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn dark color="green darken-1" @click="$emit('input', null)">Нет</v-btn>
                <v-btn color="red darken-1" dark @click="deleteKnowledgeArea()">Да</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        value: Object
    },
    methods: {
        deleteKnowledgeArea() {
            const url = "/api/knowledge-areas/" + this.knowledgeAreaToDelete.slug;
            axios
                .delete(url)
                .then(res => {
                    this.$emit('deleted');
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        knowledgeAreaToDelete: {
            get() {
                return this.value;
            },
            set(v) {
                if (!v) {
                    this.$emit("input", null);
                }
            }
        }
    }
};
</script>

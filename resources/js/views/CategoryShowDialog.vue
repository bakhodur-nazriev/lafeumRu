<template>
    <v-dialog v-model="showDialog" width="600">
        <v-card v-if="showDialog">
            <v-card-title class="pr-2 primary white--text mb-3">
                {{ category.name }}
            </v-card-title>

            <v-card-text v-html="category.description"/>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn text @click="closeDialog" color="primary darken-1">Закрыть</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        category: Object
    },
    methods: {
        showCategoryPage() {
            this.$emit('showPage', this.category);
        },
        closeDialog() {
            this.$emit('close');
        },
        editCategory() {
            this.$emit('edit', this.category);
        },
        deleteCategory() {
            this.$emit('delete', this.category);
        }
    },
    computed: {
        showDialog: {
            get() {
                return this.category;
            },
            set(show) {
                if (!show) {
                    this.closeDialog();
                }
            }
        }
    }
};
</script>

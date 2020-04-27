<template>
    <v-dialog v-model="showDialog" width="600">
        <v-card v-if="showDialog">
            <v-card-title class="headline pr-2">
                Удаление категории
            </v-card-title>

            <v-card-text class="body-1 text-center">
                Вы действительно хотите удалить категорию:
                <b>{{ category.name }}</b> ?
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="red darken-1"
                    text
                    @click="deleteCategory"
                >
                    Удалить
                </v-btn>
                <v-btn
                    color="primary darken-1"
                    text
                    @click="closeDialog"
                >
                    Отмена
                </v-btn>
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
        closeDialog() {
            this.$emit("close");
        },
        deleteCategory(){
            this.$emit('deleted', this.category);
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

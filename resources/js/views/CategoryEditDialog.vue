<template>
    <v-dialog v-model="showDialog" width="600">
        <v-card v-if="showDialog">
            <v-card-title class="headline pr-2">
                Изменение категории
            </v-card-title>

            <v-card-text>
                <v-text-field
                    label="Название"
                    outlined
                    v-model="category.name"
                />
                <v-textarea
                    label="Описание"
                    v-model="category.description"
                    outlined
                />
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="green darken-1"
                    text
                    @click="categoryEdited"
                >
                    Сохранить
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
        categoryEdited() {
            this.$emit("edited", this.category);
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

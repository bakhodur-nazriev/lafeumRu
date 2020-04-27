<template>
    <v-dialog v-model="showDialog" width="600">
        <v-card v-if="showDialog">
            <v-card-title class="headline pr-2">
                {{ category.name }}
                <v-spacer />
                <v-btn icon @click="editCategory">
                    <v-icon small>mdi-pencil</v-icon>
                </v-btn>
                <v-btn icon @click="deleteCategory">
                    <v-icon small>mdi-delete</v-icon>
                </v-btn>
            </v-card-title>

            <v-card-text>
                {{ category.description }}
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="primary darken-1"
                    text
                    @click="closeDialog"
                >
                    Закрыть
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
    methods:{
        closeDialog(){
            this.$emit('close');
        },
        editCategory(){
            this.$emit('edit', this.category);
        },
        deleteCategory(){
            this.$emit('delete', this.category);
        }
    },
    computed: {
        showDialog: {
            get(){
                return this.category;
            },
            set(show){
                if(!show){
                    this.closeDialog();
                }
            }
        }
    }
};
</script>

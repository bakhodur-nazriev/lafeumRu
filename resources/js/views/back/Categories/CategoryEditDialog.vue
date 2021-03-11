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
                    :rules="[rules.required]"
                    v-model="category.name"
                />
                <wysiwyg-editor
                    label="Описание"
                    v-model="category.description"
                />
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="green darken-1"
                    text
                    @click="updateCategory"
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
import rules from "../../../validation-rules";
import WysiwygEditor from '../../../components/WysiwygEditor';

export default {
    props: {
        category: Object
    },
    components: { WysiwygEditor },
    data(){
        return {rules}
    },
    methods: {
        closeDialog() {
            this.$emit("close");
        },
        updateCategory(){

            axios
                .put('/api/categories/' + this.category.id, this.category)
                .then(res => {
                    this.$emit("updated", res.data);
                })
                .catch(e => console.log(e));

        },
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

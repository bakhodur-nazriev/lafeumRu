<template>
    <v-dialog v-model="showDialog" width="600">
        <v-card v-if="showDialog">
            <v-card-title class="headline pr-2">
                Добавить категорию
            </v-card-title>
            <v-form ref="form" @submit="addCategory">
                <v-card-text>
                    <v-autocomplete
                        label="Родительская категория"
                        v-model="newCategory.parentId"
                        :items="categories"
                        item-text="name"
                        item-value="id"
                        outlined
                    />
                    <v-text-field
                        label="Название"
                        v-model="newCategory.name"
                        outlined
                        :rules="[rules.required]"
                    />
                    <wysiwyg-editor
                        label="Описание"
                        v-model="newCategory.description"
                    />
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="green darken-1" text type="submit">
                        Сохранить
                    </v-btn>
                    <v-btn color="primary darken-1" text @click="closeDialog">
                        Отмена
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
import rules from "../../../validation-rules";
import WysiwygEditor from '../../../components/WysiwygEditor';

export default {
    props: {
        show: Boolean,
        categoryType: {
            type: String,
            required: true
        }
    },
    components: { WysiwygEditor },
    data() {
        return {
            rules,
            categories: [],
            newCategory: {
                name: "",
                description: "",
                parentId: 0,
                type: this.categoryType
            }
        };
    },
    mounted() {
        this.loadCategoriesList();
    },
    methods: {
        closeDialog() {
            this.resetDialog();
            this.$emit("close");
        },
        resetDialog(){
            this.$refs.form.reset();
            this.newCategory = {
                name: "",
                description: "",
                parentId: 0,
                type: this.categoryType
            };
        },
        loadCategoriesList() {
            axios
                .get("/api/categories?type=" + this.categoryType)
                .then(res => this.setCategories(res.data))
                .catch(e => console.log(e));
        },
        setCategories(categories) {
            this.categories = [{ name: "Без родителя", id: 0 }, ...categories];
        },
        addCategory(e) {
            e.preventDefault();
            const validData = this.$refs.form.validate();

            if (!validData) return;

            axios
                .post("/api/categories", this.newCategory)
                .then(res => {
                    this.resetDialog();
                    this.$emit('created', res.data);
                })
                .catch(e => console.log(e));
        }
    },
    computed: {
        showDialog: {
            get() {
                return this.show;
            },
            set(show) {
                if (!show) {
                    this.closeDialog();
                }
            }
        }
    },
    watch: {
        categoryType() {
            this.loadCategoriesList();
        }
    }
};
</script>

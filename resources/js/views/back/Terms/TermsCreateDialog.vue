<template>
    <v-dialog :value="value" width="750px" @input="$emit('input', false)">
        <v-card>
            <v-form ref="createForm" @submit="addTerm">
                <v-card-title class="primary white--text">
                    Создать Термин
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12" class="py-0">
                            <v-text-field
                                dense
                                outlined
                                v-model="newTerm.name"
                                label="Введите название"
                                :rules="[rules.required]"
                            />
                        </v-col>
                        <v-col cols="12" class="py-0">
                            <v-autocomplete
                                dense
                                outlined
                                multiple
                                item-value="id"
                                item-text="name"
                                label="Область знаний"
                                :items="knowledgeAreas"
                                :rules="[rules.required]"
                                v-model="newTerm.knowledgeAreas"
                            />
                        </v-col>
                        <v-col cols="12" class="py-0">
                            <v-autocomplete
                                dense
                                outlined
                                multiple
                                item-value="id"
                                item-text="name"
                                label="Категории"
                                :items="categories"
                                :rules="[rules.required]"
                                v-model="newTerm.categories"
                            />
                        </v-col>
                        <v-col cols="12" class="py-0">
                            <v-select
                                dense
                                outlined
                                label="Тип"
                                item-value="id"
                                item-text="name"
                                :items="termTypes"
                                :rules="[rules.required]"
                                v-model="newTerm.term_type_id"
                            />
                        </v-col>
                        <v-col cols="12" class="py-0">
                            <date-picker
                                with-time
                                label="Дата публикации"
                                v-model="newTerm.publish_at"
                            />
                        </v-col>
                        <v-col cols="12" class="py-0">
                            <v-checkbox
                                class="mt-0"
                                v-model="newTerm.show_in_vocabulary"
                                label="Показать в словаре"
                            />
                        </v-col>
                        <v-col cols="12" class="py-0">
                            <wysiwyg-editor
                                v-model="newTerm.body"
                                label="Введите описание"
                                :rules="[rules.required]"
                            />
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions class="pa-3">
                    <v-spacer/>
                    <v-btn color="primary" type="submit">Сохранить</v-btn>
                    <v-btn color="primary" type="button" @click="$emit('input', false)">Отмена</v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
import rules from "../../../validation-rules";
import DatePicker from "../../../components/DatePicker";
import WysiwygEditor from "../../../components/WysiwygEditor";

export default {
    props: {
        value: Boolean,
        categories: Array,
        knowledgeAreas: Array,
        termTypes: Array
    },
    components: {
        "date-picker": DatePicker,
        "wysiwyg-editor": WysiwygEditor
    },
    data() {
        return {
            rules,
            newTerm: null,
        };
    },
    beforeMount() {
        this.newTerm = this.getDefaultTerm();
    },
    methods: {
        getDefaultTerm() {
            return {
                name: "",
                body: "",
                categories: [],
                knowledgeAreas: [],
                term_type_id: null,
                publish_at: ''
            };
        },
        resetNewTerm() {
            this.newTerm = this.getDefaultTerm();
            this.$refs.createForm.reset();
        },
        addTerm(e) {
            e.preventDefault();

            const validForm = this.$refs.createForm.validate();

            if (!validForm) return;

            axios
                .post("/api/terms", this.newTerm)
                .then(res => {
                    this.resetNewTerm();
                    this.$emit("created", res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<template>
    <v-dialog :value="value" width="700px" @input="$emit('input', false)">
        <v-card>
            <v-form ref="createForm" @submit="addTerm">
                <v-card-title class="primary white--text">
                    Создать Термин
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-text-field
                                outlined
                                hide-details
                                v-model="newTerm.name"
                                label="Введите название"
                                :rules="[rules.required]"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                outlined
                                hide-details
                                label="Ссылка"
                                v-model="newTerm.link"
                                :rules="[rules.required]"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-select
                                outlined
                                multiple
                                hide-details
                                item-value="id"
                                item-text="name"
                                label="Область знаний"
                                :items="knowledgeAreas"
                                :rules="[rules.required]"
                                v-model="newTerm.knowledgeAreas"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-select
                                outlined
                                multiple
                                hide-details
                                item-value="id"
                                item-text="name"
                                label="Категории"
                                :items="categories"
                                :rules="[rules.required]"
                                v-model="newTerm.categories"
                            />
                        </v-col>
                        <v-col cols="12">
                            <date-picker
                                label="Выберите дату"
                                :rules="[rules.required]"
                                v-model="newTerm.created_at"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-checkbox
                                class="mt-0"
                                v-model="newTerm.show_in_vocabulary"
                                label="Показать в словаре"
                            />
                        </v-col>
                        <v-col cols="12">
                            <wysiwyg-editor
                                v-model="newTerm.body"
                                label="Введите описание"
                                :rules="[rules.required]"
                            />
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" type="submit">Сохранить</v-btn>
                    <v-btn
                        dark
                        color="error"
                        type="button"
                        @click="$emit('input', false)"
                    >
                        Отмена
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
    import rules from "../validation-rules";
    import DatePicker from "../components/DatePicker";
    import WysiwygEditor from "../components/WysiwygEditor";

    export default {
        props: {
            value: Boolean,
            categories: Array,
            knowledgeAreas: Array,
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
                    link: "",
                    knowledgeAreas: [],
                    categories: [],
                };
            },
            resetNewTerm() {
                this.newTerm = this.getDefaultTerm();
                this.$refs.createForm.reset();
            },
            addTerm(e) {
                e.preventDefault();

                this.$refs.createForm.validate();

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

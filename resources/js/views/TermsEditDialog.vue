<template>
    <v-dialog v-if="termToUpdate" v-model="termToUpdate" width="700px">
        <v-card>
            <v-card-title class="primary white--text">
                Изменить Термин
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field
                            hide-details
                            outlined
                            label="Изменить название термина"
                            v-model="termToUpdate.name"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            hide-details
                            outlined
                            v-model="termToUpdate.link"
                            label="Ссылка"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-select
                            v-model="termToUpdate.knowledge"
                            :items="knowledgeAreas"
                            outlined
                            multiple
                            item-value="id"
                            item-text="name"
                            label="Область знаний"
                            :rules="[rules.required]"
                            hide-details
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-select
                            v-model="termToUpdate.categories"
                            :items="categories"
                            outlined
                            multiple
                            item-value="id"
                            item-text="name"
                            label="Категории"
                            :rules="[rules.required]"
                            hide-details
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-dialog
                            ref="dialog"
                            v-model="modalDate"
                            :return-value.sync="termToUpdate.updated_at"
                            persistent
                            width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    v-model="termToUpdate.updated_at"
                                    label="Выберите дату"
                                    prepend-inner-icon="mdi-calendar"
                                    readonly
                                    outlined
                                    v-on="on"
                                    hide-details
                                ></v-text-field>
                            </template>
                            <v-date-picker v-model="termToUpdate.updated_at" scrollable>
                                <v-spacer></v-spacer>
                                <v-btn text color="primary" @click="modalDate= false">Отмена</v-btn>
                                <v-btn text color="primary" @click="$refs.dialog.save(termToUpdate.updated_at)">OK
                                </v-btn>
                            </v-date-picker>
                        </v-dialog>
                    </v-col>
                    <v-col cols="12">
                        <wysiwyg-editor
                            v-model="termToUpdate.body"
                            label="Изменить термин"
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer/>
                <v-btn dark color="green" @click="updateTerm()">Сохранить</v-btn>
                <v-btn dark color="error" @click="termToUpdate = false">Отмена</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    import WysiwygEditor from "../components/WysiwygEditor";
    import rules from "../validation-rules";

    export default {
        props: {
            value: Object,
            knowledgeAreas: Array,
            categories: Array,
            updated_at: String
        },
        components: {
            "wysiwyg-editor": WysiwygEditor
        },
        data() {
            return {
                rules,
                modalDate: false
            };
        },
        methods: {
            updateTerm() {
                axios
                    .put("/api/terms/" + this.termToUpdate.id, {
                        name: this.termToUpdate.name,
                        body: this.termToUpdate.body,
                        updated_at: this.termToUpdate.updated_at
                    })
                    .then(res => {
                        this.$emit('updated', res.data);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        computed: {
            termToUpdate: {
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

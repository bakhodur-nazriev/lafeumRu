<template>
    <v-dialog v-if="termToUpdate" v-model="termToUpdate" width="700">
        <v-card v-if="!isSendingData">
            <v-card-title class="primary white--text pa-4">
                Изменить Термин
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field
                            outlined
                            hide-details
                            :rules="[rules.required]"
                            v-model="termToUpdate.name"
                            label="Изменить название термина"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            outlined
                            hide-details
                            label="Ссылка"
                            :rules="[rules.required]"
                            v-model="termToUpdate.link"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-autocomplete
                            outlined
                            multiple
                            hide-details
                            item-value="id"
                            item-text="name"
                            label="Область знаний"
                            :items="knowledgeAreas"
                            :rules="[rules.required]"
                            v-model="termToUpdate.knowledge"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-autocomplete
                            outlined
                            multiple
                            hide-details
                            item-value="id"
                            item-text="name"
                            label="Категории"
                            :items="categories"
                            :rules="[rules.required]"
                            v-model="termToUpdate.categories"
                        />
                    </v-col>
                    <v-col cols="12">
                        <date-picker
                            label="Изменить дату"
                            :rules="[rules.required]"
                            v-model="termToUpdate.updated_at"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-checkbox
                            class="mt-0"
                            v-model="termToUpdate.show_in_vocabulary"
                            label="Показать в словаре"
                        />
                    </v-col>
                    <v-col cols="12">
                        <wysiwyg-editor
                            :rules="[rules.required]"
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
        <v-card v-else>
            <div class="py-5 text-center">
                <v-progress-circular indeterminate color="primary"/>
            </div>
        </v-card>
    </v-dialog>
</template>

<script>
    import WysiwygEditor from "../components/WysiwygEditor";
    import DatePicker from "../components/DatePicker";
    import rules from "../validation-rules";

    export default {
        props: {
            knowledgeAreas: Array,
            categories: Array,
            value: Object,
        },
        components: {
            "date-picker": DatePicker,
            "wysiwyg-editor": WysiwygEditor
        },
        data() {
            return {
                isSendingData: false,
                modalDate: false,
                rules
            };
        },
        methods: {
            updateTerm() {
               let updatedTerm = this.termToUpdate;

                updatedTerm.categories = this.extractIds(updatedTerm.categories);
                updatedTerm.knowledge = this.extractIds(updatedTerm.knowledge);

                axios
                    .put("/api/terms/" + this.termToUpdate.id, updatedTerm,{
                        name: this.termToUpdate.name,
                        body: this.termToUpdate.body,
                        link: this.termToUpdate.link,
                        categories: this.termToUpdate.categories,
                        updated_at: this.termToUpdate.updated_at
                    })
                    .then(res => {
                        this.isSendingData = false;
                        this.$emit('updated', res.data);
                    })
                    .catch(err => {
                        this.isSendingData = false;
                        console.log(err);
                    });
            },
            extractIds(array) {
                return array.map(a => {
                    return typeof a === 'number' ? a : (a.hasOwnProperty('id') ? a.id : null);
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

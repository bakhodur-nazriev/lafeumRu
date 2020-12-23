<template>
    <v-dialog v-model="showDialog" max-width="700">
        <v-card v-if="showDialog">
            <v-card-title class="primary white--text pa-4">
                Термин
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field
                            v-model="term.name"
                            outlined
                            readonly
                            label="Названия"
                            hide-details
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            v-model="term.link"
                            outlined
                            readonly
                            label="Сылка"
                            hide-details
                        />
                    </v-col>
                    <v-col cols="12">
                        <fieldset class="category-fieldset">
                            <legend class="category-fieldset-legend mb-0">Категории</legend>
                            <div class="pb-2">
                                <v-chip
                                    v-for="(category, i) in term.categories"
                                    :key="i"
                                    class="ma-2"
                                    color="primary"
                                >
                                    <v-icon class="mr-2" small>mdi-tag</v-icon>
                                    {{ category.name }}
                                </v-chip>
                            </div>
                        </fieldset>
                    </v-col>
                    <v-col cols="12">
                        <fieldset class="knowledge-fieldset">
                            <legend class="knowledge-fieldset-legend mb-0">Область знаний</legend>
                            <div class="pb-2">
                                <v-chip
                                    v-for="(knowledeArea, i) in term.knowledge"
                                    :key="i"
                                    class="ma-2"
                                    color="primary"
                                >
                                    <v-icon class="mr-2" small>mdi-tag</v-icon>
                                    {{ knowledeArea.name }}
                                </v-chip>
                            </div>
                        </fieldset>
                    </v-col>
                    <v-col cols="12">
                        <wysiwyg-editor
                            v-model="term.body"
                            label="Описания"
                            disabled
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            v-model="term.created_at"
                            outlined
                            readonly
                            label="Дата добавления"
                            hide-details
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            v-model="term.updated_at"
                            outlined
                            readonly
                            label="Дата изменения"
                            hide-details
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer/>
                <v-btn
                    dark
                    color="primary"
                    @click="closeDialog"
                >
                    Закрыть
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    import WysiwygEditor from "../../components/WysiwygEditor";

    export default {
        props: {
            term: Object,
            categories: Array
        },
        components: {"wysiwyg-editor": WysiwygEditor},
        methods: {
            closeDialog() {
                this.$emit('close');
            }
        },
        computed: {
            showDialog: {
                get() {
                    return this.term
                },
                set(show) {
                    if (!show) {
                        this.closeDialog();
                    }
                }
            }
        }
    }
</script>

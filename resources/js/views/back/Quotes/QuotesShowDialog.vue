<template>
    <v-dialog v-model="showDialog" max-width="700">
        <v-card v-if="showDialog">
            <v-card-title class="primary white--text pa-4">
                Цитата
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field
                            outlined
                            readonly
                            hide-details
                            label="Автор"
                            v-model="quote.author.name"
                        />
                    </v-col>
                    <v-col cols="12">
                        <fieldset class="category-fieldset">
                            <legend class="category-fieldset-legend mb-0">Категории</legend>
                            <div class="pb-2">
                                <v-chip
                                    v-for="(category, i) in quote.categories"
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
                        <wysiwyg-editor
                            outlined
                            readonly
                            disabled
                            hide-details
                            label="Описания"
                            v-model="quote.body"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            v-model="quote.created_at"
                            outlined
                            readonly
                            label="Дата добавления"
                            hide-details
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            v-model="quote.updated_at"
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
    import WysiwygEditor from "../../../components/WysiwygEditor";

    export default {
        components: {"wysiwyg-editor": WysiwygEditor},
        props: {
            quote: Object,
            categories: Array
        },
        methods: {
            closeDialog() {
                this.$emit('close');
            }
        },
        computed: {
            showDialog: {
                get() {
                    return this.quote
                },
                set(show) {
                    if (!show) {
                        this.closeDialog();
                    }
                }
            }
        },
    }
</script>

<template>
    <v-dialog v-if="quoteToUpdate" v-model="quoteToUpdate" width="700">
        <v-card v-if="!isSendingData">
            <v-card-title class="primary white--text pa-4">
                Изменить Цитату
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-autocomplete
                            outlined
                            hide-details
                            label="Авторы"
                            item-value="id"
                            item-text="name"
                            :items="authors"
                            :rules="[rules.required]"
                            v-model="quoteToUpdate.author_id"
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
                            v-model="quoteToUpdate.categories"
                        />
                    </v-col>
                    <v-col cols="12">
                        <date-picker
                            label="Изменить дату"
                            :rules="[rules.required]"
                            v-model="quoteToUpdate.updated_at"
                        />
                    </v-col>
                    <v-col cols="12">
                        <wysiwyg-editor
                            outlined
                            hide-details
                            label="Изменить цитату"
                            :rules="[rules.required]"
                            v-model="quoteToUpdate.body"
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer/>
                <v-btn dark color="green" @click="updateQuote()">Сохранить</v-btn>
                <v-btn dark color="error" @click="quoteToUpdate = false">Отмена</v-btn>
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
    import rules from "../validation-rules"
    import DatePicker from "../components/DatePicker";
    import WysiwygEditor from "../components/WysiwygEditor";


    export default {
        components: {
            "date-picker": DatePicker,
            "wysiwyg-editor": WysiwygEditor
        },
        props: {
            value: Object, //quote
            authors: Array,
            categories: Array,
        },
        data() {
            return {
                rules,
                isSendingData: false,
                modalDate: false,
            }
        },
        methods: {
            updateQuote() {
                this.isSendingData = true;

                let updatedQuote = this.quoteToUpdate;
                updatedQuote.categories = this.extractIds(updatedQuote.categories);
                axios
                    .put("/api/quotes/" + this.quoteToUpdate.id, updatedQuote, {
                        body: this.quoteToUpdate.body,
                        author_id: this.quoteToUpdate.author_id,
                        categories: this.quoteToUpdate.categories,
                        updated_at: this.quoteToUpdate.updated_at
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
            quoteToUpdate: {
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

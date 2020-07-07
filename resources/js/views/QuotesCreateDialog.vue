<template>
    <v-dialog :value="value" width="700" @input="$emit('input', false)">
        <v-card>
            <v-form @submit="addQuote" ref="createForm" v-if="!isSendingData">
                <v-card-title class="primary white--text">
                    Создать Цитату
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-select
                                outlined
                                hide-details
                                label="Автор"
                                item-value="id"
                                item-text="name"
                                :items="authors"
                                :rules="[rules.required]"
                                v-model="newQuote.author_id"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-select
                                outlined
                                multiple
                                hide-details
                                :items="categories"
                                item-value="id"
                                item-text="name"
                                label="Категории"
                                :rules="[rules.required]"
                                v-model="newQuote.categories"
                            />
                        </v-col>
                        <v-col cols="12">
                            <date-picker
                                label="Добавить дату"
                                :rules="[rules.required]"
                                v-model="newQuote.created_at"
                            />
                        </v-col>
                        <v-col cols="12">
                            <wysiwyg-editor
                                v-model="newQuote.body"
                                :rules="[rules.required]"
                                label="Введите цитату здесь"
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
            <div class="py-5 text-center" v-else>
                <v-progress-circular indeterminate color="primary"/>
            </div>
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
            authors: Array,
            categories: Array,
        },
        components: {
            "date-picker": DatePicker,
            "wysiwyg-editor": WysiwygEditor
        },
        data() {
            return {
                rules,
                newQuote: null,
                isSendingData: false
            }
        },
        beforeMount() {
            this.newQuote = this.getDefaultQuote();
        },
        methods: {
            getDefaultQuote() {
                return {
                    body: "",
                    author_id: null,
                    categories: null,
                };
            },
            resetNewQuoteForm() {
                this.newQuote = this.getDefaultQuote();
            },
            addQuote(e) {
                e.preventDefault();

                this.isSendingData = true;

                const validForm = this.$refs.createForm.validate();

                if (!validForm) return;

                axios
                    .post("/api/quotes/", this.newQuote)
                    .then(res => {
                        this.isSendingData = false;
                        this.resetNewQuoteForm();
                        this.$emit('created', res.data);
                    })
                    .catch(err => {
                        this.isSendingData = false;
                        console.log(err);
                    });
            }
        },
    };
</script>

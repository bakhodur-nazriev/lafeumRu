<template>
    <v-dialog :value="value" width="700" @input="$emit('input', false)">
        <v-card>
            <v-form ref="createForm" @submit="addQuote">
                <v-card-title class="primary white--text">
                    Создать Цитату
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12 py-0">
                            <v-autocomplete
                                outlined
                                label="Автор"
                                item-value="id"
                                item-text="name"
                                :items="authors"
                                :rules="[rules.required]"
                                v-model="newQuote.author_id"
                            />
                        </v-col>
                        <v-col cols="12 py-0">
                            <v-autocomplete
                                outlined
                                multiple
                                item-value="id"
                                item-text="name"
                                label="Категории"
                                :items="categories"
                                :rules="[rules.required]"
                                v-model="newQuote.categories"
                            />
                        </v-col>
                        <v-col cols="12 py-0">
                            <date-picker
                                with-time
                                label="Дата публикации"
                                v-model="newQuote.publish_at"
                            />
                        </v-col>
                        <v-col cols="12 py-0">
                            <wysiwyg-editor
                                v-model="newQuote.body"
                                label="Введите цитату здесь"
                                :rules="[rules.required]"
                            />
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" type="submit">Сохранить</v-btn>
                    <v-btn dark color="error" type="button" @click="$emit('input', false)">
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
                newQuote: null
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
                    categories: [],
                    publish_at: ""
                };
            },
            resetNewQuote() {
                this.newQuote = this.getDefaultQuote();
                this.$refs.createForm.reset();
            },
            addQuote(e) {
                e.preventDefault();

                const validForm = this.$refs.createForm.validate();

                if (!validForm) return;

                axios
                    .post("/api/quotes", this.newQuote)
                    .then(res => {
                        this.resetNewQuote();
                        this.$emit('created', res.data);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
    };
</script>

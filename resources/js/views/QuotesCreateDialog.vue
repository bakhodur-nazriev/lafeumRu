<template>
    <v-dialog :value="value" width="700" @input="$emit('input', false)">
        <v-card>
            <v-form @submit="addQuote" ref="createForm" v-if="!isSendingData">
                <v-card-title class="primary white--text mb-5">
                    Создать Цитату
                </v-card-title>
                <v-card-text>
                    <v-select
                        outlined
                        :items="authors"
                        item-value="id"
                        item-text="name"
                        label="Автор"
                        :rules="[rules.required]"
                        v-model="newQuote.author_id"
                    />
                    <v-select
                        outlined
                        multiple
                        :items="categories"
                        item-value="id"
                        item-text="name"
                        label="Категории"
                        :rules="[rules.required]"
                        v-model="newQuote.categories"
                    />
                    <v-dialog
                        ref="dialog"
                        v-model="modalDate"
                        :return-value.sync="newQuote.created_at"
                        persistent
                        width="290px"
                    >
                        <template v-slot:activator="{ on }">
                            <v-text-field
                                v-model="newQuote.created_at"
                                label="Выберите дату"
                                prepend-inner-icon="mdi-calendar"
                                readonly
                                outlined
                                v-on="on"
                                :rules="[rules.required]"
                            ></v-text-field>
                        </template>
                        <v-date-picker v-model="newQuote.created_at" scrollable>
                            <v-spacer></v-spacer>
                            <v-btn text color="primary" @click="modalDate= false">Отмена</v-btn>
                            <v-btn text color="primary" @click="$refs.dialog.save(newQuote.created_at)">OK</v-btn>
                        </v-date-picker>
                    </v-dialog>
                    <wysiwyg-editor
                        v-model="newQuote.body"
                        label="Введите цитату здесь"
                    />
                </v-card-text>
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
    import WysiwygEditor from "../components/WysiwygEditor";
    import rules from "../validation-rules";

    export default {
        props: {
            value: Boolean,
            authors: Array,
            categories: Array,
        },
        components: {
            "wysiwyg-editor": WysiwygEditor
        },
        data() {
            return {
                rules,
                newQuote: null,
                isSendingData: false,
                modalDate: false
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
                this.showDialog = false;
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

<template>
    <v-dialog v-if="quoteToUpdate" v-model="quoteToUpdate" width="750">
        <v-card>
            <v-card-title class="primary white--text pa-4">
                Изменить Цитату
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12" class="py-0">
                        <v-select
                            dense
                            outlined
                            label="Авторы"
                            item-value="id"
                            item-text="name"
                            :items="authors"
                            :rules="[rules.required]"
                            v-model="quoteToUpdate.author_id"
                        />
                    </v-col>
                    <v-col class="py-0">
                        <v-textarea
                            dense
                            outlined
                            label="Мысли автора"
                            v-model="quoteToUpdate.authors_thoughts"
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
                            v-model="quoteToUpdate.categories"
                        />
                    </v-col>
                    <v-col cols="12" class="py-0">
                        <date-picker
                            with-time
                            label="Дата публикации"
                            v-model="quoteToUpdate.publish_at"
                        />
                    </v-col>
                    <v-col cols="12" class="py-0">
                        <wysiwyg-editor
                            outlined
                            label="Изменить цитату"
                            :rules="[rules.required]"
                            v-model="quoteToUpdate.body"
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions class="pa-3">
                <v-spacer/>
                <v-btn color="primary" @click="updateQuote()">Сохранить</v-btn>
                <v-btn color="primary" @click="quoteToUpdate = false">Отмена</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import rules from "../../../validation-rules"
import DatePicker from "../../../components/DatePicker";
import WysiwygEditor from "../../../components/WysiwygEditor";


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
            modalDate: false,
        }
    },
    methods: {
        updateQuote() {

            let updatedQuote = this.quoteToUpdate;
            updatedQuote.categories = this.extractIds(updatedQuote.categories);
            axios
                .put("/api/quotes/" + this.quoteToUpdate.id, updatedQuote)
                .then(res => {
                    this.$emit('updated', res.data);
                })
                .catch(err => {
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

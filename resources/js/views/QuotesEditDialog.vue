<template>
    <v-dialog v-if="quoteToUpdate" v-model="quoteToUpdate" width="700">
        <v-card>
            <v-card-title class="primary white--text">
                Изменить Цитату
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-select
                            hide-details
                            outlined
                            item-value="id"
                            item-text="name"
                            label="Авторы"
                            :items="authors"
                            v-model="quoteToUpdate.author_id"
                        >
                        </v-select>
                    </v-col>
                    <v-col cols="12">
                        <v-select
                            hide-details
                            outlined
                            multiple
                            item-value="id"
                            item-text="name"
                            label="Категории"
                            :items="categories"
                            v-model="quoteToUpdate.categories"
                        >
                        </v-select>
                    </v-col>
                    <v-col cols="12">
                        <wysiwyg-editor
                            label="Изменить цитату"
                            v-model="quoteToUpdate.body"
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer />
                <v-btn dark color="green" @click="updateQuote()"
                    >Сохранить</v-btn
                >
                <v-btn dark color="error" @click="quoteToUpdate = false"
                    >Отмена</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import WysiwygEditor from "../components/WysiwygEditor";

export default {
    props: {
        value: Object, //quote
        authors: Array,
        categories: Array
    },
    components: {
        "wysiwyg-editor": WysiwygEditor
    },
    methods: {
        updateQuote() {
            axios
                .put("/api/quotes/" + this.quoteToUpdate.id, {
                    body: this.quoteToUpdate.body,
                    author_id: this.quoteToUpdate.author_id
                })
                .then(res => {
                    this.quoteToUpdate = res.data;
                    this.$emit('updated', res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        quoteToUpdate: {
            get(){
                return this.value;
            },
            set(v){
                if(!v){
                    this.$emit('input', null);
                }
            }
        }
    }
};
</script>

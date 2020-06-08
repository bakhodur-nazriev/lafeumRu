<template>
    <v-dialog v-if="quoteToUpdate" v-model="quoteToUpdate" width="700px">
        <v-card v-if="!isSendingData">
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
                        />
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
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-dialog
                            ref="dialog"
                            v-model="modalDate"
                            :return-value.sync="date"
                            persistent
                            width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    v-model="date"
                                    label="Выберите дату"
                                    prepend-inner-icon="mdi-calendar"
                                    readonly
                                    outlined
                                    v-on="on"
                                    hide-details
                                ></v-text-field>
                            </template>
                            <v-date-picker v-model="date" scrollable>
                                <v-spacer></v-spacer>
                                <v-btn text color="primary" @click="modalDate= false">Отмена</v-btn>
                                <v-btn text color="primary" @click="$refs.dialog.save(date)">OK</v-btn>
                            </v-date-picker>
                        </v-dialog>
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
        data() {
            return {
                isSendingData: false,
                modalDate: false,
                date: new Date().toISOString().substr(0, 10),
            }
        },
        methods: {
            updateQuote() {
                this.isSendingData = true;
                axios
                    .put("/api/quotes/" + this.quoteToUpdate.id, {
                        body: this.quoteToUpdate.body,
                        author_id: this.quoteToUpdate.author_id
                    })
                    .then(res => {
                        this.isSendingData = false;
                        this.quoteToUpdate = res.data;
                        this.$emit('updated', res.data);
                    })
                    .catch(err => {
                        this.isSendingData = false;
                        console.log(err);
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

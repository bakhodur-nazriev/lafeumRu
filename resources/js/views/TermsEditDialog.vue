<template>
    <v-dialog v-if="termToUpdate" v-model="termToUpdate" width="700px">
        <v-card>
            <v-card-title class="primary white--text">
                Изменить Термин
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field
                            hide-details
                            outlined
                            label="Изменить название термина"
                            v-model="termToUpdate.name"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            hide-details
                            outlined
                            v-model="termToUpdate.link"
                            label="Ссылка"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-select
                            v-model="termToUpdate.knowledge"
                            :items="knowledgeAreas"
                            outlined
                            multiple
                            item-value="id"
                            item-text="name"
                            label="Область знаний"
                            :rules="[rules.required]"
                            hide-details
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-select
                            v-model="termToUpdate.categories"
                            :items="categories"
                            outlined
                            multiple
                            item-value="id"
                            item-text="name"
                            label="Категории"
                            :rules="[rules.required]"
                            hide-details
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
    </v-dialog>
</template>

<script>
    import WysiwygEditor from "../components/WysiwygEditor";
    import rules from "../validation-rules";

export default {
    props: {
        value: Object,
        knowledgeAreas: Array,
        categories: Array
    },
    components: {
        "wysiwyg-editor": WysiwygEditor
    },
    data() {
        return { rules };
    },
    methods: {
        updateTerm() {
            let updatedTerm = this.termToUpdate;

            updatedTerm.categories = this.extractIds(updatedTerm.categories);
            updatedTerm.knowledge = this.extractIds(updatedTerm.knowledge);

            axios
                .put("/api/terms/" + updatedTerm.id, updatedTerm)
                .then(res => {
                    this.$emit('updated', res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        },
        extractIds(array){
            return array.map(a => {
                return typeof a === 'number' ? a: (a.hasOwnProperty('id') ? a.id: null);
            });
        }
    },
    computed: {
        termToUpdate: {
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

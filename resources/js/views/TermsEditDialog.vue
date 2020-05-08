<template>
    <v-dialog v-if="termToUpdate" v-model="termToUpdate" width="700px">
        <v-card>
            <v-card-title class="primary white--text">
                Изменить Термин
            </v-card-title>
            <v-container>
                <v-text-field
                    outlined
                    label="Изменить название термина"
                    v-model="termToUpdate.name"
                />
                <v-text-field
                    outlined
                    v-model="termToUpdate.link"
                    label="Ссылка"
                />
                <v-select
                    v-model="termToUpdate.knowledge"
                    :items="knowledgeAreas"
                    outlined
                    multiple
                    item-value="id"
                    item-text="name"
                    label="Область знаний"
                    :rules="[rules.required]"
                />
                <v-select
                    v-model="termToUpdate.categories"
                    :items="categories"
                    outlined
                    multiple
                    item-value="id"
                    item-text="name"
                    label="Категории"
                    :rules="[rules.required]"
                />
                <wysiwyg-editor
                    v-model="termToUpdate.body"
                    label="Изменить термин здесь"
                />
            </v-container>
            <v-card-actions>
                <v-spacer />
                <v-btn dark color="green" @click="updateTerm()"
                    >Сохранить
                </v-btn>
                <v-btn dark color="error" @click="termToUpdate = false"
                    >Отмена
                </v-btn>
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
            axios
                .put("/api/terms/" + this.termToUpdate.id, {
                    name: this.termToUpdate.name,
                    body: this.termToUpdate.body
                })
                .then(res => {
                    this.$emit('updated', res.data);
                })
                .catch(err => {
                    console.log(err);
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

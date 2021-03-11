<template>
    <v-dialog
        v-if="knowledgeAreaToUpdate"
        v-model="knowledgeAreaToUpdate"
        width="700"
    >
        <v-card>
            <v-card-title class="primary white--text">
                Изменить области зананий
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field
                            hide-details
                            outlined
                            v-model="knowledgeAreaToUpdate.name"
                            label="Изменить области знаний здесь"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <wysiwyg-editor
                            v-model="knowledgeAreaToUpdate.description"
                            label="Изменить описание области знания"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-autocomplete
                            label="Связанные области знаний"
                            v-model="knowledgeAreaToUpdate.linked_knowledge"
                            :items="knowledgeAreas"
                            item-text="name"
                            item-value="id"
                            multiple
                            outlined
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer />
                <v-btn dark color="green" @click="updateKnowledgeArea()"
                    >Сохранить</v-btn
                >
                <v-btn dark color="error" @click="$emit('input', null)"
                    >Отмена</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import WysiwygEditor from '../../../components/WysiwygEditor';

export default {
    props: {
        value: Object,
        knowledgeAreas: Array
    },
    components: { WysiwygEditor },
    methods: {
        updateKnowledgeArea() {
            const url = "/api/knowledge-areas/" + this.knowledgeAreaToUpdate.slug;
            axios
                .put(url, this.knowledgeAreaToUpdate)
                .then(res => {
                    this.$emit('updated', res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        knowledgeAreaToUpdate: {
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
}
</script>

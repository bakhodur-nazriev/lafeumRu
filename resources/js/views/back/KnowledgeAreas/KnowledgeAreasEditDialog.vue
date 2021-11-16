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
                    <v-col cols="12" class="py-0">
                        <v-text-field
                            dense
                            outlined
                            hide-details
                            v-model="knowledgeAreaToUpdate.name"
                            label="Изменить области знаний здесь"
                        />
                    </v-col>
                    <v-col cols="12" class="py-0">
                        <wysiwyg-editor
                            v-model="knowledgeAreaToUpdate.description"
                            label="Изменить описание области знания"
                        />
                    </v-col>
                    <v-col cols="12" class="py-0">
                        <v-autocomplete
                            dense
                            outlined
                            multiple
                            item-value="id"
                            item-text="name"
                            :items="knowledgeAreas"
                            label="Связанные области знаний"
                            v-model="knowledgeAreaToUpdate.linked_knowledge"
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer/>
                <v-btn dark color="primary" @click="updateKnowledgeArea()">Сохранить</v-btn>
                <v-btn dark color="primary" @click="$emit('input', null)">Отмена</v-btn>
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
    components: {WysiwygEditor},
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
}
</script>

<template>
    <v-dialog :value="value" width="700px" @input="$emit('input', false)">
        <v-card>
            <v-card-title class="primary white--text">
                Создать области знаний
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12" class="py-0">
                        <v-text-field
                            dense
                            outlined
                            name="name"
                            hide-details
                            v-model="newKnowledge.name"
                            label="Добавить имя области знаний"
                        />
                    </v-col>
                    <v-col cols="12" class="py-0">
                        <wysiwyg-editor
                            v-model="newKnowledge.description"
                            label="Добавить описание области знания"
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
                            v-model="newKnowledge.linked_knowledge"
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer/>
                <v-btn dark color="primary" @click="addKnowledgeArea()">Сохранить</v-btn>
                <v-btn dark color="primary" @click="$emit('input', false)">Отмена</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import WysiwygEditor from '../../../components/WysiwygEditor';

export default {
    props: {
        value: Boolean,
        knowledgeAreas: Array
    },
    components: {WysiwygEditor},
    data() {
        return {
            newKnowledge: null
        }
    },
    beforeMount() {
        this.newKnowledge = this.getDefaultKnowledge();
    },
    methods: {
        getDefaultKnowledge() {
            return {
                name: '',
                description: '',
                linked_knowledge: []
            }
        },
        addKnowledgeArea() {
            axios
                .post("/api/knowledge-areas", this.newKnowledge)
                .then(res => {
                    this.$emit('created', res.data);
                })
                .catch(err => console.log(err));
        }
    }
};
</script>

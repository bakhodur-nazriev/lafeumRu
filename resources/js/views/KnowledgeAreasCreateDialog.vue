<template>
    <v-dialog :value="value" width="700px" @input="$emit('input', false)">
        <v-card>
            <v-card-title class="primary white--text">
                Создать области знаний
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field
                            label="Добавить имя области знаний"
                            v-model="newKnowledge.name"
                            hide-details
                            outlined
                            name="name"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            label="Добавить описание области знания"
                            v-model="newKnowledge.description"
                            outlined
                            hide-details
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-autocomplete
                            label="Связанные области знаний"
                            v-model="newKnowledge.linked_knowledge"
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
                <v-btn dark color="green" @click="addKnowledgeArea()"
                    >Сохранить</v-btn
                >
                <v-btn dark color="error" @click="$emit('input', false)"
                    >Отмена</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        value: Boolean,
        knowledgeAreas: Array
    },
    data(){
        return {
            newKnowledge: null
        }
    },
    beforeMount(){
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

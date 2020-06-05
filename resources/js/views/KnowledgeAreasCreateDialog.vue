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
                            hide-details
                            outlined
                            name="name"
                            v-model="newKnowledge.name"
                            label="Добаить имя области знаний"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            outlined
                            v-model="newKnowledge.description"
                            label="Добавить описания области знаний"
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
        value: Boolean
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
                description: ''
            }
        },
        addKnowledgeArea() {
            axios
                .post("/api/knowledge-areas/", this.newKnowledge)
                .then(res => {
                    this.$emit('created', res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

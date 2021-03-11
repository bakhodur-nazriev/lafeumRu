<template>
    <v-dialog v-model="showDialog" width="600">
        <v-card v-if="showDialog">
            <v-card-title class="pr-2 primary white--text mb-3">
                {{ knowledgeArea.name }}
                <v-spacer/>
                <v-btn icon @click="showKnowledgeArea">
                    <v-icon color="white" small>mdi-eye</v-icon>
                </v-btn>
                <v-btn icon @click="editCategory">
                    <v-icon color="white" small>mdi-pencil</v-icon>
                </v-btn>
                <v-btn icon @click="deleteCategory">
                    <v-icon color="white" small>mdi-delete</v-icon>
                </v-btn>
            </v-card-title>

            <v-card-text class="pb-0">
                <div
                    class="subtitle-1"
                    v-html="knowledgeArea.description || 'Нет описания'"
                />
                <div class="pb-2">
                    <v-chip
                        v-for="(knowledge, i) in knowledgeArea.linked_knowledge"
                        :key="i"
                        class="ma-2"
                        color="primary"
                    >
                        {{ knowledge.name }}
                    </v-chip>
                </div>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary darken-1" text @click="closeDialog">
                    Закрыть
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        knowledgeArea: Object
    },
    methods:{
        closeDialog(){
            this.$emit('close');
        },
        editCategory(){
            this.$emit('edit', this.knowledgeArea);
        },
        deleteCategory(){
            this.$emit('delete', this.knowledgeArea);
        }
    },
    computed: {
        showDialog: {
            get(){
                return this.knowledgeArea;
            },
            set(show){
                if(!show){
                    this.closeDialog();
                }
            }
        }
    }
};
</script>

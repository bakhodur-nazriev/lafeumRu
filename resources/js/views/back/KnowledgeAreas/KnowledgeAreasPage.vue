<template>
    <v-main class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-card class="col-lg-12 col-xl-8 pa-4" v-if="!knowledgeAreasLoading">
                    <div class="d-flex mb-3">
                        <v-spacer />
                        <v-btn
                            color="green accent-4 white--text"
                            outlined
                            small
                            @click="saveKnowledgeTree"
                        >
                            Сохранить структуру
                        </v-btn>
                    </div>
                    <tree-view
                        :treeData="knowledgeAreasTree"
                        item-text="name"
                        ref="treeView"
                        @node-click="knowledgeAreaToShow = $event"
                    />
                </v-card>
                <v-progress-circular indeterminate color="primary" v-else />
            </v-row>
        </v-container>
        <v-tooltip top>
            <template v-slot:activator="{ on }">
                <v-btn
                    bottom
                    color="primary"
                    v-on="on"
                    dark
                    fab
                    fixed
                    right
                    @click="dialogAdd = !dialogAdd"
                >
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>
            <span>Добавить видео</span>
        </v-tooltip>

        <knowledge-areas-show-dialog
            :knowledgeArea="knowledgeAreaToShow"
            @close="knowledgeAreaToShow = null"
            @edit="onKnowledgeEdit"
            @delete="onKnowledgeDelete"
        />

        <knowledge-areas-create-dialog
            v-model="dialogAdd"
            :knowledge-areas="knowledgeAreasList"
            @created="knowledgeCreated"
        />

        <knowledge-areas-edit-dialog
            v-model="knowledgeAreaToUpdate"
            :knowledge-areas="knowledgeAreasList"
            @updated="knowledgeUpdated"
        />

        <knowledge-areas-delete-dialog
            v-model="knowledgeAreaToDelete"
            @deleted="knowledgeDeleted"
        />
    </v-main>
</template>
<script>
import TreeView from "../../../components/TreeView";
import KnowledgeAreasShowDialog from "./KnowledgeAreasShowDialog";
import KnowledgeAreasCreateDialog from "./KnowledgeAreasCreateDialog";
import KnowledgeAreasEditDialog from "./KnowledgeAreasEditDialog";
import KnowledgeAreasDeleteDialog from "./KnowledgeAreasDeleteDialog";

export default {
    components: {
        TreeView,
        KnowledgeAreasShowDialog,
        KnowledgeAreasCreateDialog,
        KnowledgeAreasEditDialog,
        KnowledgeAreasDeleteDialog
    },
    data() {
        return {
            knowledgeAreaToShow: null,
            knowledgeAreaToDelete: null,
            knowledgeAreaToUpdate: null,
            search: "",
            dialogAdd: false,
            knowledgeAreasTree: [],
            knowledgeAreasList: [],
            knowledgeAreasLoading: false
        };
    },
    mounted() {
        this.loadKnowledgeAreasTree();
        this.loadKnowledgeAreasList();
    },
    methods: {
        saveKnowledgeTree() {
            this.knowledgeAreasLoading = true;
            let knowledgeTree = this.$refs.treeView.getTree();

            axios
                .put("/api/knowledge-areas", {
                    knowledgeAreas: knowledgeTree
                })
                .then(r => {
                    this.knowledgeAreasLoading = false;
                    this.knowledgeAreasTree = r.data;
                })
                .catch(e => {
                    this.knowledgeAreasLoading = false;
                    console.log(e);
                });
        },
        onKnowledgeClick(knowledge) {
            this.knowledgeAreaToUpdate = knowledge;
        },
        loadKnowledgeAreasList(){
            axios
                .get("/api/knowledge-areas")
                .then(res => {
                    this.knowledgeAreasList = res.data;
                })
                .catch(err => console.log(err));
        },
        loadKnowledgeAreasTree() {
            this.knowledgeAreasLoading = true;

            axios
                .get("/api/knowledge-areas?tree")
                .then(res => {
                    this.knowledgeAreasLoading = false;
                    this.knowledgeAreasTree = res.data;
                })
                .catch(err => {
                    this.knowledgeAreasLoading = false;
                    console.log(err);
                });
        },
        onKnowledgeEdit(knowledge){
            this.knowledgeAreaToShow = null;
            this.knowledgeAreaToUpdate = knowledge;
        },
        onKnowledgeDelete(knowledge){
            this.knowledgeAreaToShow = null;
            this.knowledgeAreaToDelete = knowledge;
        },
        knowledgeCreated() {
            this.dialogAdd = false;
            this.loadKnowledgeAreasTree();
        },
        knowledgeUpdated() {
            this.knowledgeAreaToUpdate = null;
            this.loadKnowledgeAreasTree();
        },
        knowledgeDeleted() {
            this.knowledgeAreaToDelete = null;
            this.loadKnowledgeAreasTree();
        }
    }
};
</script>

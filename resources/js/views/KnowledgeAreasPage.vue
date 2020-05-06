<template>
    <v-content class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-col md="6">
                    <v-text-field
                        solo
                        label="Поиск"
                        hide-details
                        class="mb-1"
                        v-model="search"
                        append-icon="mdi-magnify"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-data-table
                        :headers="headers"
                        :items="filteredKnowledgeAreas"
                        :items-per-page="itemsPerPage"
                        :page.sync="page"
                        @page-count="pageCount = $event"
                        hide-default-footer
                        class="elevation-1"
                    >
                        <template v-slot:item.action="{ item }">
                            <v-btn
                                fab
                                dark
                                small
                                color="primary"
                                elevation="2"
                                outlined
                                @click="knowledgeAreaToUpdate = { ...item }"
                            >
                                <v-icon dark>mdi-pen</v-icon>
                            </v-btn>
                            <v-btn
                                fab
                                dark
                                small
                                color="error"
                                elevation="2"
                                outlined
                                @click="knowledgeAreaToDelete = item"
                            >
                                <v-icon dark>mdi-delete</v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.description="{ item }">
                            <div
                                v-html="item.description"
                                class="short-paragraph"
                            ></div>
                        </template>
                    </v-data-table>
                </v-col>
                <div class="text-center pt-2">
                    <v-pagination
                        v-model="page"
                        :length="pageCount"
                        :total-visible="7"
                    />
                </div>
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

        <knowledge-areas-create-dialog
            v-model="dialogAdd"
            @created="knowledgeCreated"
        />

        <knowledge-areas-edit-dialog
            v-model="knowledgeAreaToUpdate"
            @updated="knowledgeUpdated"
        />

        <knowledge-areas-delete-dialog
            v-model="knowledgeAreaToDelete"
            @deleted="knowledgeDeleted"
        />
        
    </v-content>
</template>
<script>
import KnowledgeAreasCreateDialog from "./KnowledgeAreasCreateDialog";
import KnowledgeAreasEditDialog from "./KnowledgeAreasEditDialog";
import KnowledgeAreasDeleteDialog from "./KnowledgeAreasDeleteDialog";

export default {
    components: {
        KnowledgeAreasCreateDialog,
        KnowledgeAreasEditDialog,
        KnowledgeAreasDeleteDialog
    },
    data() {
        return {
            knowledgeAreaToDelete: null,
            knowledgeAreaToUpdate: null,
            search: "",
            dialogAdd: false,
            knowledgeAreas: [],
            page: 1,
            pageCount: 2,
            itemsPerPage: 12,
            headers: [
                {
                    text: "Имя",
                    value: "name",
                    sortable: false
                },
                {
                    text: "Описания",
                    value: "description",
                    sortable: false
                },
                {
                    text: "Действия",
                    value: "action",
                    align: "center",
                    sortable: false,
                    width: "160px"
                }
            ]
        };
    },
    mounted() {
        this.loadKnowledgeAreas();
    },
    methods: {
        loadKnowledgeAreas() {
            axios
                .get("/api/knowledge-areas")
                .then(res => {
                    this.knowledgeAreas = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },
        knowledgeCreated() {
            this.dialogAdd = false;
            this.loadKnowledgeAreas();
        },
        knowledgeUpdated() {
            this.knowledgeAreaToUpdate = null;
            this.loadKnowledgeAreas();
        },
        knowledgeDeleted() {
            this.knowledgeAreaToDelete = null;
            this.loadKnowledgeAreas();
        },
    },
    computed: {
        filteredKnowledgeAreas() {
            return this.knowledgeAreas.filter(knowledgeArea => {
                return knowledgeArea.name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        }
    }
};
</script>

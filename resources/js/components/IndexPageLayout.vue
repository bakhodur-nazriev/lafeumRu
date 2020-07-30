<template>
    <v-content class="pa-0">
        <v-container fluid>
            <v-row justify="center">
                <v-col md="6" xl="4">
                    <v-text-field
                        solo
                        hide-details
                        class="mb-1"
                        label="Поиск"
                        v-model="search"
                        append-icon="mdi-magnify"
                    />
                </v-col>
                <v-col cols="12">
                    <v-data-table
                        :headers="processedHeaders"
                        :items="filteredItems"
                        :items-per-page="perPage"
                        hide-default-footer
                        class="elevation-2"
                        :loading="loadingItems"
                        loading-text="Загрузка..."
                        @click:row="$emit('click:item', $event)"
                    >
                        <template
                            v-for="(_, name) in $scopedSlots"
                            :slot="name"
                            slot-scope="slotData"
                        >
                            <slot :name="name" v-bind="slotData"/>
                        </template>

                        <template
                            v-if="!noActions"
                            v-slot:item.action="{ item }"
                        >
                            <v-btn
                                fab
                                dark
                                small
                                color="primary"
                                elevation="2"
                                outlined
                                @click.stop="$emit('update-item', { ...item })"
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
                                @click.stop="$emit('delete-item', { ...item })"
                            >
                                <v-icon dark>mdi-delete</v-icon>
                            </v-btn>
                        </template>
                    </v-data-table>
                    <v-col class="text-center mt-2">
                        <v-pagination
                            :total-visible="7"
                            v-model="currentPage"
                            :length="totalPages"
                        ></v-pagination>
                    </v-col>
                </v-col>
            </v-row>
            <v-tooltip top v-if="!noActions">
                <template v-slot:activator="{ on }">
                    <v-btn
                        bottom
                        color="primary"
                        v-on="on"
                        dark
                        fab
                        fixed
                        right
                        @click="$emit('add-item')"
                    >
                        <v-icon>mdi-plus</v-icon>
                    </v-btn>
                </template>
                <span>{{addLabel}}</span>
            </v-tooltip>
        </v-container>
    </v-content>
</template>

<script>
export default {
    props: {
        indexUrl: String,
        tableHeaders: Array,
        addLabel: String,
        noActions: Boolean,
        searchField: String
    },
    data() {
        return {
            items: [],
            search: "",
            pagination: null,
            loadingItems: false
        };
    },
    mounted() {
        this.loadItems();
    },
    methods: {
        getSlotName(fieldName) {
            return "item." + fieldName;
        },
        getIndexUrl(page) {
            let url = this.indexUrl;

            if (!url.includes("?")) {
                url += "?";
            }
            url += "&page=";

            if (page) {
                url += page;
            } else {
                url += this.currentPage;
            }

            return url;
        },
        processResponse({ data }) {
            this.loadingItems = false;

            const hasPagination = data.hasOwnProperty("data");

            if (hasPagination) {
                this.items = data.data;
                this.pagination = data;
            } else {
                this.items = data;
                this.pagination = null;
            }
        },
        loadItems(page = null) {
            this.loadingItems = true;
            this.items = [];

                axios
                    .get(this.getIndexUrl(page))
                    .then(this.processResponse)
                    .catch(err => {
                        this.loadingItems = false;
                        console.log(err);
                    });

                this.pagination = null;
            }
        },
        computed: {
            processedHeaders() {
                if (this.noActions) {
                    return this.tableHeaders;
                }

            return [
                ...this.tableHeaders,
                {
                    text: "Действия",
                    value: "action",
                    align: "center",
                    sortable: false,
                    width: "160px"
                }
            ];
        },
        filteredItems() {
            if (!Array.isArray(this.items)) return [];

            if (!this.searchField) return this.items;

            return this.items.filter(item => {
                return item[this.searchField]
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
        currentPage: {
            get() {
                if (this.pagination) {
                    return this.pagination.current_page;
                }
                return 1;
            },
            set(v) {
                this.loadItems(v);
            }
        },
        totalPages() {
            return this.pagination ? this.pagination.last_page: null;
        },
        perPage() {
            if (this.pagination) {
                return this.pagination.per_page;
            }
            return this.items.length;
        }
    }
};
</script>

<style>
    .category-fieldset,
    .knowledge-fieldset {
        border: 1px solid #9e9e9e;
        border-radius: 5px;
        padding-left: 8px;
    }

    .category-fieldset-legend {
        color: #9e9e9e;
        font-size: 14px;
        max-width: 12%;
        padding: 0 3px 0 5px;
    }

    .knowledge-fieldset-legend {
        color: #9e9e9e;
        font-size: 14px;
        max-width: 17%;
        padding: 0 2px 0 4px;
    }
</style>

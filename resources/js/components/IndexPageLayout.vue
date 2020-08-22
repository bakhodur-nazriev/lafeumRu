<template>
    <v-content class="pa-0">
        <v-container fluid>
            <v-row justify="center">
                <v-col cols="6">
                    <v-text-field
                        solo
                        hide-details
                        class="mb-1"
                        label="Поиск"
                        v-model="search"
                        append-icon="mdi-magnify"
                    />
                </v-col>
            </v-row>
            <v-row class="align-center">
                <v-col cols="4" v-if="categories">
                    <v-select
                        solo
                        dense
                        hide-details
                        multiple
                        label="Все рубрики"
                        item-text="name"
                        item-value="id"
                        :items="categories"
                        v-model="enabled"
                    >
                    </v-select>
                </v-col>
                <v-col cols="6" v-if="pagination">
                    <span class="ml-2">{{pagination.total}}: Элементов</span>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <v-data-table
                        hide-default-footer
                        class="elevation-2"
                        :headers="processedHeaders"
                        :items="filteredItems"
                        :items-per-page="perPage"
                        :server-items-length="totalCount"
                        :loading="loadingItems"
                        loading-text="Загрузка..."

                        @update:options="onUpdateOptions"
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
                        fab
                        dark
                        right
                        fixed
                        bottom
                        v-on="on"
                        color="primary"
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
            searchField: String,
            searchFieldCategory: String,
            categories: Array
        },
        data() {
            return {
                items: [],
                search: "",
                enabled: null,
                pageData: null,
                pagination: null,
                loadingItems: false
            };
        },
        created() {
            this.pageData = {
                number: 1,
                sortBy: null,
                sortDesc: false
            };
        },
        methods: {
            getSlotName(fieldName) {
                return "item." + fieldName;
            },
            getIndexUrl() {
                let url = this.indexUrl;

                if (!url.includes("?")) {
                    url += "?";
                }

                url += ("&page=" + this.currentPage);

                if (this.pageData.sortBy) {

                    if (this.pageData.sortDesc) {
                        url += "&sortByDesc=" + this.pageData.sortBy;
                    } else {
                        url += "&sortBy=" + this.pageData.sortBy;
                    }
                }
                if (this.search) {
                    url += "&search=" + this.search;
                }
                return url;
            },
            processResponse({data}) {
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
            loadItems() {
                this.loadingItems = true;
                this.items = [];

                axios
                    .get(this.getIndexUrl())
                    .then(this.processResponse)
                    .catch(err => {
                        this.loadingItems = false;
                        console.log(err);
                    });

                this.pagination = null;
            },
            onUpdateOptions(options) {
                let sortApplied =
                    this.pageData.sortBy &&
                    options.sortBy[0] === this.pageData.sortBy &&
                    options.sortDesc[0] === this.pageData.sortDesc;

                if (sortApplied) return;

                if (options.sortBy.length) {
                    this.pageData = {
                        ...this.pageData,
                        sortBy: options.sortBy[0],
                        sortDesc: options.sortDesc[0]
                    };
                } else if (!options.sortBy.length && this.pageData.sortBy) {
                    this.pageData = {
                        ...this.pageData,
                        sortBy: null,
                        sortDesc: false
                    };
                }
            }
        },
        watch: {
            enabled(categories) {
                if (categories === '') {
                    this.items = [];
                } else {
                    this.search = null
                    this.items.categories
                }
            },
            search() {
                this.loadItems();
            },
            pageData(v) {
                this.loadItems();
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

                if (!this.searchFieldCategory) return this.items;

                return this.items.filter(item => {
                    return item[this.searchField].toLowerCase().includes(this.search.toLowerCase());
                });
            },
            currentPage: {
                get() {
                    return this.pageData.number;
                },
                set(v) {
                    this.pageData = {...this.pageData, number: v};
                }
            },
            totalPages() {
                return this.pagination ? this.pagination.last_page : null;
            },
            totalCount() {
                return this.pagination ? this.pagination.total : null;
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

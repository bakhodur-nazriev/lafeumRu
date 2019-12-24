<template>
    <v-content class="pa-0">
        <v-container fluid>
            <v-row justify="center">
                <v-col cols="6">
                    <v-text-field
                        solo
                        label="Поиск"
                        append-icon="mdi-magnify"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-data-table
                :headers="headers"
                :items="desserts"
                sort-by="calories"
                class="elevation-2"
            >

                <template v-slot:item.action="{ item }">
                    <v-btn fab dark small color="primary" elevation="1">
                        <v-icon dark>
                            mdi-pen
                        </v-icon>
                    </v-btn>
                    <v-btn fab dark small color="primary" elevation="1">
                        <v-icon dark>
                            mdi-delete
                        </v-icon>
                    </v-btn>
                </template>
                <template v-slot:no-data>
                    <v-btn color="primary" @click="initialize">Reset</v-btn>
                </template>
            </v-data-table>
        </v-container>

        <v-tooltip top>
            <template v-slot:activator="{ on }">
                <v-btn bottom color="primary" v-on="on" dark fab fixed right @click="dialog = !dialog">
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>
            <span>Добавить цитату</span>
        </v-tooltip>

        <v-dialog v-model="dialogDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center"
                >Вы действительно хотите удалить эту цитату ?
                </v-card-title
                >
                <v-card-actions class="justify-center">
                    <v-btn color="green darken-1" dark @click="dialogDelete = false">
                        Не
                    </v-btn>
                    <v-btn color="red darken-1" dark @click="dialogDelete = false">
                        Ҳа
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog
            v-model="dialogAdd"
            width="600px"
        >
            <v-card>
                <v-card-title class="primary white--text">
                    Создать Цитату
                </v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-select
                                :items="items"
                                label="Категории"
                                dense
                            ></v-select>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                name="input-7-1"
                                label="Default style"
                                value="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
                                hint="Hint text"
                            ></v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn
                        dark
                        color="green"
                        @click="dialog = false"
                    >Сохранить
                    </v-btn>
                    <v-btn
                        dark
                        color="error"
                        @click="dialog = false"
                    >Отмена
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-content>
</template>

<script>
    export default {
        data() {
            return {
                quotes: [],
                dialogAdd: false,
                dialogDelete: false,
                items: ['qwe', 'asd', 'zxc'],
                filters: [
                    {
                        value: 0,
                        fn: (item, queryText, itemText) => item.indexOf(queryText) > -1,
                        text: 'Exact Match',
                    },
                    {
                        value: 1,
                        fn: (item, queryText, itemText) => queryText.length > 2 && item.toLowerCase().indexOf(queryText) > -1,
                        text: 'Search Length > 2 & Loose Match',
                    },
                ],
                headers: [
                    {text: '№', value: 'counter'},
                    {
                        text: 'Dessert (100g serving)',
                        align: 'left',
                        sortable: false,
                        value: 'name',
                    },
                    {text: 'Calories', value: 'calories'},
                    {text: 'Carbs (g)', value: 'carbs'},
                    {text: 'Protein (g)', value: 'protein'},
                    {text: 'Действия', value: 'action', sortable: false},
                ],
                desserts: [],
                editedIndex: -1,
                editedItem: {
                    name: '',
                    calories: 0,
                    fat: 0,
                    carbs: 0,
                    protein: 0,
                },
                defaultItem: {
                    name: '',
                    calories: 0,
                    fat: 0,
                    carbs: 0,
                    protein: 0,
                },
            }
        },

        watch: {
            dialog(val) {
                val || this.close()
            },
        },
        created() {
            this.initialize()
        },
        methods: {
            initialize() {
                this.desserts = [
                    {
                        name: 'Frozen Yogurt',
                        calories: 159,
                        fat: 6.0,
                        carbs: 24,
                        protein: 4.0,
                    },
                    {
                        name: 'Ice cream sandwich',
                        calories: 237,
                        fat: 9.0,
                        carbs: 37,
                        protein: 4.3,
                    },
                    {
                        name: 'Eclair',
                        calories: 262,
                        fat: 16.0,
                        carbs: 23,
                        protein: 6.0,
                    },
                    {
                        name: 'Cupcake',
                        calories: 305,
                        fat: 3.7,
                        carbs: 67,
                        protein: 4.3,
                    }

                ]
            },
        },
    }
</script>

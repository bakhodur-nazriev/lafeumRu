<template>
<!--    <v-app id="inspire">-->
        <v-content class="pa-0">
            <v-container fluid>
                <v-text-field
                    flat
                    solo-inverted
                    hide-details
                    prepend-inner-icon="mdi-magnify"
                    label="Поиск"
                    class="hidden-sm-and-down"
                    color="primary"
                />
            </v-container>

        <v-btn
            bottom
            color="primary"
            dark
            fab
            fixed
            right
            @click="dialog = !dialog"
        >
            <v-icon>mdi-plus</v-icon>
        </v-btn>
        <v-dialog
            v-model="dialog"
            width="800px"
        >
            <v-card>
                <v-card-title class="grey darken-2">
                    Create contact
                </v-card-title>
                <v-container>
                    <v-row class="mx-2">
                        <v-col
                            class="align-center justify-space-between"
                            cols="12"
                        >
                            <v-row
                                align="center"
                                class="mr-0"
                            >
                                <v-avatar
                                    size="40px"
                                    class="mx-3"
                                >
                                    <img
                                        src="//ssl.gstatic.com/s2/oz/images/sge/grey_silhouette.png"
                                        alt=""
                                    >
                                </v-avatar>
                                <v-text-field
                                    placeholder="Name"
                                />
                            </v-row>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field
                                prepend-icon="business"
                                placeholder="Company"
                            />
                        </v-col>
                        <v-col cols="6">
                            <v-text-field
                                placeholder="Job title"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                prepend-icon="mail"
                                placeholder="Email"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                type="tel"
                                prepend-icon="phone"
                                placeholder="(000) 000 - 0000"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                prepend-icon="notes"
                                placeholder="Notes"
                            />
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-btn
                        text
                        color="primary"
                    >More
                    </v-btn>
                    <v-spacer/>
                    <v-btn
                        text
                        color="primary"
                        @click="dialog = false"
                    >Cancel
                    </v-btn>
                    <v-btn
                        text
                        @click="dialog = false"
                    >Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
<!--    </v-app>-->
    </v-content>
</template>

<script>
    export default {
        data() {
            return {
                dialog: false,
                model: null,
                states: [
                    'Alabama', 'Alaska', 'American Samoa', 'Arizona',
                    'Arkansas', 'California', 'Colorado', 'Connecticut',
                    'Delaware', 'District of Columbia', 'Federated States of Micronesia',
                    'Florida', 'Georgia', 'Guam', 'Hawaii', 'Idaho',
                    'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky',
                    'Louisiana', 'Maine', 'Marshall Islands', 'Maryland',
                    'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi',
                    'Missouri', 'Montana', 'Nebraska', 'Nevada',
                    'New Hampshire', 'New Jersey', 'New Mexico', 'New York',
                    'North Carolina', 'North Dakota', 'Northern Mariana Islands', 'Ohio',
                    'Oklahoma', 'Oregon', 'Palau', 'Pennsylvania', 'Puerto Rico',
                    'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee',
                    'Texas', 'Utah', 'Vermont', 'Virgin Island', 'Virginia',
                    'Washington', 'West Virginia', 'Wisconsin', 'Wyoming',
                ],
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
            }
        },

        computed: {
            activeFilter() {
                if (this.model == null) return undefined
                return this.filters[this.model].fn
            },
        },
    }
</script>

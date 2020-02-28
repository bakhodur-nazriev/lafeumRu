<template>
    <v-container>
        <v-row justify="center">
            <v-col md="6">
                <v-text-field
                    solo
                    hide-details
                    label="Поиск"
                    append-icon="mdi-magnify"
                    v-model="search"
                >
                </v-text-field>
            </v-col>
        </v-row>
        <v-row class="mb-3 px-4">
            <v-tooltip top>
                <template v-slot:activator="{ on }">
                    <v-btn
                        v-on="on"
                        small
                        color="grey lighten-3 mr-2"
                        elevation="0"
                        @click="sortBy('title')"
                    >
                        <v-icon small>mdi-folder</v-icon>
                        <span class="caption lwercase">By project name</span>
                    </v-btn>
                </template>
                <span>Sort by project name</span>
            </v-tooltip>

            <v-tooltip top>
                <template v-slot:activator="{ on }">
                    <v-btn
                        v-on="on"
                        small
                        color="grey lighten-3"
                        elevation="0"
                        @click="sortBy('person')"
                    >
                        <v-icon left small>mdi-account</v-icon>
                        <span class="caption lwercase">By person</span>
                    </v-btn>
                </template>
                <span>Sort by person</span>
            </v-tooltip>
        </v-row>

        <v-card
            flat
            v-for="project in projects"
            :key="project.title"
            class="mb-4 pl-4"
            :style="'border-left: ' + project.borderLeft"
        >
            <v-row align="center">
                <v-col cols="xs-6 sm-4 md-2">
                    <span class="caption grey--text">Author</span><br>
                    <span>{{ project.person }}</span>
                </v-col>
                <v-col cols="xs-12 md-6">
                    <span class="caption grey--text">Project title</span><br>
                    <span>{{ project.title }}</span>
                </v-col>
                <v-col cols="xs-6 sm-4 md-2">
                    <span class="caption grey--text">Due by</span><br>
                    <span>{{ project.due }}</span>
                </v-col>
                <v-col cols="xs-2 sm-4 md-2">
                    <v-col align="center">
                        <v-chip
                            small
                            class="caption my-2 white--text"
                            :color="`${project.background}`"
                        >
                            {{ project.status }}
                        </v-chip>
                    </v-col>
                </v-col>
            </v-row>
        </v-card>
    </v-container>
</template>
<script>
    export default {
        data() {
            return {
                search: "",
                favourites: [],
                projects: [
                    {
                        title: "Aesign a new website",
                        person: "Bakhodur Nazriev",
                        due: "10 Jan 2018",
                        status: "complete",
                        borderLeft: "4px solid #3cd1c2",
                        background: "#3cd1c2",
                        content:
                            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo natus voluptas tenetur culpa ratione incidunt id dicta iure eius harum!"
                    },
                    /*{
                        title: "Cesign a new website",
                        person: "Shavkat Khojaev",
                        due: "10 Jan 2018",
                        status: "ongoing",
                        borderLeft: "4px solid #ffaa2c",
                        background: "#ffaa2c",
                        content:
                            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo natus voluptas tenetur culpa ratione incidunt id dicta iure eius harum!"
                    },
                    {
                        title: "Fesign a new website",
                        person: "Odina Rahmatov",
                        due: "10 Jan 2018",
                        status: "ongoing",
                        borderLeft: "4px solid #ffaa2c",
                        background: "#ffaa2c",
                        content:
                            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo natus voluptas tenetur culpa ratione incidunt id dicta iure eius harum!"
                    },
                    {
                        title: "Wesign a new website",
                        person: "Jack London",
                        due: "10 Jan 2018",
                        status: "overdue",
                        borderLeft: "4px solid #f83e70",
                        background: "#f83e70",
                        content:
                            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo natus voluptas tenetur culpa ratione incidunt id dicta iure eius harum!"
                    }*/
                ]
            };
        },
        mounted() {
            this.loadFavourites();
            axios
                .get("/api/quotes")
                .then(res => {
                    this.favourites = res.data();
                })
                .catch(err => {
                    console.log(err);
                })
        },
        methods: {
            loadFavourites() {
                axios
                    .get("/api/quotes")
                    .then(res => {
                        this.favourites = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            deleteFavourite() {
                axios
                    .delete("" + this.favouriteToDelete.id)
                    .then(res => {
                        this.loadFavourites();
                        this.favouriteToDelete = false;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            sortBy(prop) {
                this.projects.sort((a, b) => (a[prop] < b[prop] ? -1 : 1));
            },
        },
        computed: {
            filteredFavorite() {
                return this.favourites.filter(favourite => {
                    return favourite.name.toLowerCase().includes(this.search.toLowerCase());
                })
            }
        }
    };
</script>

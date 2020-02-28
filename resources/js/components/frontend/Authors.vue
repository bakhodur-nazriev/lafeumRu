<template>
    <v-content class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-col cols="12">
                    <p class="text-center display-1 headary--text">Авторы</p>
                    <p class="text-center">
                        Авторы цитат, афоризмов и высказываний, представленных на сайте.
                    </p>
                </v-col>
                <v-col cols="5">
                    <v-text-field
                        dense
                        solo
                        hide-details
                        class="mb-1"
                        label="Поиск"
                        append-icon="mdi-magnify"
                        v-model="search"
                    >
                    </v-text-field>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col
                    cols="2"
                    class="pa-1 mt-1"
                    v-for="author in filteredAuthors"
                    :key="author.id"
                >
                    <a href="">
                        {{ author.name }}
                    </a>
                </v-col>
            </v-row>
        </v-container>
    </v-content>
</template>
<script>
    export default {
        props: ["authors"],
        data() {
            return {
                search: ""
            };
        },

        computed: {
            filteredAuthors() {
                return this.authors.filter(author => {
                    return author.name.toLowerCase().includes(this.search.toLowerCase());
                });
            }
        }
    };
</script>

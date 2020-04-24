<template>
    <v-app class="grey lighten-4">
        <navbar/>

        <v-content class="mx-4 my-2">
            <router-view/>
        </v-content>
    </v-app>
</template>

<script>
    import navbar from "./layouts/TheNavbar";

    export default {
        props: ["users"],
        name: "App",
        components: {navbar},
        data() {
            return {};
        },
    };
</script>

<style>
    .v-application p {
        margin-bottom: 0;
    }

    .theme--light.v-data-table thead tr:last-child th {
        font-size: 15px;
        font-weight: bold;
    }

    .v-application
    .error--text {
        outline: none;
    }

    .v-application
    .primary--text {
        outline: none;
    }

    .v-application
    .primary {
        outline: none;
    }

    .short-paragraph p {
        white-space: nowrap;
        overflow: hidden;
        padding: 5px;
        text-overflow: ellipsis;
        width: 52vw;
    }

    .mine-table-headers {
        font-size: 18px;
    }

    .tiptap-vuetify-editor__toolbar .v-toolbar {
        justify-content: center;
    }

    :focus {
        outline: none !important;
    }
</style>

<template>
    <v-app class="grey lighten-3">
        <navbar/>


        <v-main class="mx-4 my-2">
            <router-view/>
        </v-main>

    </v-app>
</template>

<script>
import navbar from "./layouts/FrontNavbar";

export default {
    components: {navbar},
    name: "frontApp",
    data() {
        return {}
    }
}

</script>

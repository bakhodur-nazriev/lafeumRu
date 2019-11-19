<template>
  <v-app class="grey lighten-4">
    <Navbar />
    <v-content class="mx-4 my-2">
      <router-view />
    </v-content>
  </v-app>
</template>

<script>
import Navbar from "./Navbar";

export default {
  name: "App",
  components: { Navbar },
  data() {
    return {};
  }
};
</script>

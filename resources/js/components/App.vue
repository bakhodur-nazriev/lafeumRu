<template>
  <v-app class="grey lighten-4">
    <Navbar :users="users"/>

    <v-content class="mx-4 my-2">
      <router-view />
    </v-content>
  </v-app>
</template>

<script>
import Navbar from "./Navbar";

export default {
  props: ["users"],
  name: "App",
  components: { Navbar },
  data() {
    console.log(this.user);
    return {};
  }
};
</script>

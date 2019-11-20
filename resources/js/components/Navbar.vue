<template>
  <nav>
    <v-app-bar app color="grey--text" flat>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title class="text-uppercase grey--text">
        <span class="font-weight-light">ToDo</span>
        <span>Mine</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-bell</v-icon>
      </v-btn>

      <v-menu offset-y>
        <template v-slot:activator="{ on }">
          <v-btn class="grey--text" text v-on="on">
            <v-icon left>mdi-chevron-down</v-icon>
            <span>Menu</span>
          </v-btn>
        </template>
        <v-list>
          <v-list-item
            v-for="link in links"
            :key="link.text"
            router
            :to="link.route"
          >
            <v-list-item-title>{{ link.text }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
      <!-- dropdown menu -->

      <v-btn text dark color="grey" @click="$refs.logoutform.submit()">
        <span>Sign Out</span>
        <v-icon right>mdi-exit-to-app</v-icon>
      </v-btn>

      <form
        ref="logoutform"
        action="/logout"
        method="POST"
        style="display: none;"
      >
        <input type="hidden" name="_token" :value="csrf" />
      </form>
    </v-app-bar>

    <v-navigation-drawer v-model="drawer" class="primary" app>
      <v-layout column align-center>
        <v-flex class="mt-5 text-center">
          <v-avatar size="100">
            <!-- <v-img src="/developer.png"></v-img> -->
          </v-avatar>
          <p class="white--text subheading mt-1">
              Bakhodur Nazriev
          </p>
        </v-flex>
        <!-- <v-flex>
          <Popup class="mt-5 mb-3" />
        </v-flex> -->
      </v-layout>
      <v-list>
        <v-list-item
          v-for="link in links"
          :key="link.text"
          :to="link.route"
          router
        >
          <v-list-item-icon>
            <v-icon color="white" v-text="link.icon"></v-icon>
          </v-list-item-icon>
          <v-list-item-content class="white--text">
            <v-list-item-title v-text="link.text"> </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </nav>
</template>

<script>
export default {
  props: ["route", "users"],
  data() {
    return {
      csrf: window.Laravel.csrf_token,
      drawer: true,
      links: [
        { icon: "mdi-view-dashboard", text: "Dashboard", route: "/" },
        { icon: "mdi-folder", text: "My Projects", route: "/projects" },
        { icon: "mdi-account-group", text: "Группа", route: "/group" },
        { icon: "mdi-post", text: "Публикации", route: "/publications" },
        { icon: "mdi-post", text: "Профил", route: "/profile" }
      ]
    };
  }
};
</script>

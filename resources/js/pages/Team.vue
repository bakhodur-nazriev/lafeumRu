<template>
  <div class="team">
    <h1 class="subtitle-1 grey--text">Team Page</h1>

    <v-container class="my-5">
      <v-layout row wrap>
        <v-flex xs12 sm6 md4 lg3 v-for="person in team" :key="person.name">
          <v-card flat class="ma-3" align="center">
            <div class="pt-4">
              <v-avatar size="120" class="grey lighten-2">
                <v-img :src="person.avatar" alt="avatart" />
              </v-avatar>
            </div>

            <v-card-text>
              <div class="subheading">{{ person.name }}</div>
              <div class="grey--text">{{ person.role }}</div>
            </v-card-text>
            <v-card-actions>
              <v-btn text outlined>
                <v-icon small left>mdi-message</v-icon>
                <span>Message</span>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
      team: [
        {
          name: "The Net Ninja",
          role: "Web developer",
          avatar: "/developer.png"
        },
        { name: "Ruy", role: "Graphic Designer", avatar: "/developer.png" },
        {
          name: "Chun Li",
          role: "Socila media mavarick",
          avatar: "/developer.png"
        },
        { name: "Yoshi", role: "Sales middle", avatar: "/developer.png" }
      ]
    };
  }
};
</script>

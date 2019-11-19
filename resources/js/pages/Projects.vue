<template>
  <div class="projects">
    <h1 class="subtitle-1 grey--text">This is Projects page</h1>

    <v-container class="my-5">
      <v-expansion-panels>
        <v-expansion-panel v-for="project in myProjects" :key="project.title">
          <v-expansion-panel-header>{{
            project.title
          }}</v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-card flat>
              <v-card-text class="px-4 grey--text">
                <div class="font-weight-bold">due by {{ project.due }}</div>
                <div>{{ project.content }}</div>
              </v-card-text>
            </v-card>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
      projects: [
        {
          title: "Aesign a new website",
          person: "Bakhodur Nazriev",
          due: "17 Fab 2019",
          status: "complete",
          content:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo natus voluptas tenetur culpa ratione incidunt id dicta iure eius harum!"
        },
        {
          title: "Cesign a new website",
          person: "Shavkat Khojaev",
          due: "22 Jule 2012",
          status: "ongoing",
          content:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo natus voluptas tenetur culpa ratione incidunt id dicta iure eius harum!"
        },
        {
          title: "Fesign a new website",
          person: "Odina Rahmatov",
          due: "31 Oct 2014",
          status: "ongoing",
          content:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo natus voluptas tenetur culpa ratione incidunt id dicta iure eius harum!"
        },
        {
          title: "Wesign a new website",
          person: "Jack London",
          due: "25 March 2013",
          status: "overdue",
          content:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo natus voluptas tenetur culpa ratione incidunt id dicta iure eius harum!"
        },
        {
          title: "Lorem a new website",
          person: "Shavkat Khojaev",
          due: "22 Jule 2012",
          status: "ongoing",
          content:
            "Elit. Quo natus voluptas tenetur culpa ratione incidunt id dicta iure eius harum!"
        },
      ]
    };
  },
  computed: {
    myProjects() {
      return this.projects.filter(project => {
        return project.person == "Shavkat Khojaev";
      });
    }
  }
};
</script>

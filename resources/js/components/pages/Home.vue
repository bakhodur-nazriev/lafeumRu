<template>
  <div class="dahsboard">
    <h1 class="subtitle-1 grey--text">Home Page!</h1>

<!--    <v-container class="my-5">-->
<!--      <v-layout row class="mb-3">-->
<!--        <v-tooltip top>-->
<!--          <template v-slot:activator="{ on }">-->
<!--            <v-btn-->
<!--              v-on="on"-->
<!--              small-->
<!--              color="grey lighten-3 mr-2"-->
<!--              elevation="0"-->
<!--              @click="sortBy('title')"-->
<!--            >-->
<!--              <v-icon small>mdi-folder</v-icon>-->
<!--              <span class="caption lwercase">By project name</span>-->
<!--            </v-btn>-->
<!--          </template>-->
<!--          <span>Sort by project name</span>-->
<!--        </v-tooltip>-->

<!--        <v-tooltip top>-->
<!--          <template v-slot:activator="{ on }">-->
<!--            <v-btn-->
<!--              v-on="on"-->
<!--              small-->
<!--              color="grey lighten-3"-->
<!--              elevation="0"-->
<!--              @click="sortBy('person')"-->
<!--            >-->
<!--              <v-icon left small>mdi-account</v-icon>-->
<!--              <span class="caption lwercase">By person</span>-->
<!--            </v-btn>-->
<!--          </template>-->
<!--          <span>Sort by person</span>-->
<!--        </v-tooltip>-->
<!--      </v-layout>-->

<!--      <v-card flat v-for="project in projects" :key="project.title">-->
<!--        <v-layout row wrap :class="`pa-3 project ${project.status}`">-->
<!--          <v-flex xs12 md6>-->
<!--            <div class="caption grey&#45;&#45;text">-->
<!--              Project title-->
<!--            </div>-->
<!--            <div>{{ project.title }}</div>-->
<!--          </v-flex>-->
<!--          <v-flex xs6 sm4 md2>-->
<!--            <div class="caption grey&#45;&#45;text">-->
<!--              Person-->
<!--            </div>-->
<!--            <div>{{ project.person }}</div>-->
<!--          </v-flex>-->
<!--          <v-flex xs6 sm4 md2>-->
<!--            <div class="caption grey&#45;&#45;text">-->
<!--              Due by-->
<!--            </div>-->
<!--            <div>{{ project.due }}</div>-->
<!--          </v-flex>-->
<!--          <v-flex xs2 sm4 md2>-->
<!--            <div align="center">-->
<!--              <v-chip-->
<!--                small-->
<!--                :class="`caption my-3 white&#45;&#45;text ${project.status}`"-->
<!--                >{{ project.status }}</v-chip-->
<!--              >-->
<!--            </div>-->
<!--          </v-flex>-->
<!--        </v-layout>-->
<!--        <v-divider></v-divider>-->
<!--      </v-card>-->
<!--    </v-container>-->
  </div>
</template>

<!--<script>-->
<!--export default {-->
<!--  data() {-->
<!--    return {-->
<!--      projects: [-->
<!--        {-->
<!--          title: "Aesign a new website",-->
<!--          person: "Bakhodur Nazriev",-->
<!--          due: "10 Jan 2018",-->
<!--          status: "complete",-->
<!--          content:-->
<!--            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo natus voluptas tenetur culpa ratione incidunt id dicta iure eius harum!"-->
<!--        },-->
<!--        {-->
<!--          title: "Cesign a new website",-->
<!--          person: "Shavkat Khojaev",-->
<!--          due: "10 Jan 2018",-->
<!--          status: "ongoing",-->
<!--          content:-->
<!--            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo natus voluptas tenetur culpa ratione incidunt id dicta iure eius harum!"-->
<!--        },-->
<!--        {-->
<!--          title: "Fesign a new website",-->
<!--          person: "Odina Rahmatov",-->
<!--          due: "10 Jan 2018",-->
<!--          status: "ongoing",-->
<!--          content:-->
<!--            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo natus voluptas tenetur culpa ratione incidunt id dicta iure eius harum!"-->
<!--        },-->
<!--        {-->
<!--          title: "Wesign a new website",-->
<!--          person: "Jack London",-->
<!--          due: "10 Jan 2018",-->
<!--          status: "overdue",-->
<!--          content:-->
<!--            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo natus voluptas tenetur culpa ratione incidunt id dicta iure eius harum!"-->
<!--        }-->
<!--      ]-->
<!--    };-->
<!--  },-->
<!--  methods: {-->
<!--    sortBy(prop) {-->
<!--      this.projects.sort((a, b) => (a[prop] < b[prop] ? -1 : 1));-->
<!--    }-->
<!--  }-->
<!--};-->
<!--</script>-->

<style scoped>
.theme--light.v-chip:not(.v-chip--active).complete {
  background: #3cd1c2;
}
.theme--light.v-chip:not(.v-chip--active).ongoing {
  background: #ffaa2c;
}
.theme--light.v-chip:not(.v-chip--active).overdue {
  background: #f83e70;
}

.project.complete {
  border-left: 4px solid #3cd1c2;
}
.project.ongoing {
  border-left: 4px solid orange;
}
.project.overdue {
  border-left: 4px solid tomato;
}
</style>

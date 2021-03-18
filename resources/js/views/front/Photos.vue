<template>
  <v-col cols="8">
    <v-row>
      <v-col cols="4" v-for="(photo, i) in allPhotos" :key="i">
        <v-card
          class=""
          elevation="0"
          width="367"
          height="264"
          rounded="lg"
        >
          <v-card-text class="d-flex justify-content-center align-items-center h-100">
            <v-img max-width="268" height="180" class="d-flex" :src="photo.path"></v-img>
            {{ photo.description }}
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-btn class="btn" fab small elevation="0" rounded color="grey lighten-2">
      <v-icon color="white">mdi-arrow-down</v-icon>
    </v-btn>
    <v-pagination v-model="page" :length="3"></v-pagination>
  </v-col>
</template>

<script>
export default {
  props: ["photos"],

  data() {
    return {
      allPhotos: this.photos,
      page: 1,
      pageCustom: 1,
    };
  }
};
</script>

<style scoped="scoped">
.btn:active {
  border: none;
}
</style>
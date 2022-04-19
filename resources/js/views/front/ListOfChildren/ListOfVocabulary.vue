<template>
  <div class="mb-0">
    <v-col class="subtitle-2 pa-0 font-weight-light">
      <v-hover
        v-slot="{ hover }"
        v-for="(child ,i) in item.children"
        :key="i"
      >
        <a
          :href="'/' + child.id"
          target="_blank"
          class="vocabulary-words text-decoration-none d-block"
        >
          <span>{{ child.name }}</span>
          <v-card
            elevation="18"
            class="vocabulary-body rounded-lg pa-3"
            v-show="hover"
          >
            <div v-html="child.body" style="overflow: hidden; max-height: 195px;"></div>
          </v-card>
        </a>
      </v-hover>
    </v-col>
  </div>
</template>

<script>

export default {
  name: "ListOfChildren",
  props: ["item"],
  data() {
    return {}
  },
}
</script>

<style scoped>
.vocabulary-body {
  position: absolute;
  background-color: #fff;
  margin-top: 3px;
  z-index: 1000;
}

.vocabulary-words {
  color: #494949;
  width: fit-content;
  font-weight: normal;
}

.vocabulary-words:hover {
  color: #1a718c;
}

.toggle-button > i {
  color: #444444 !important;
}
</style>

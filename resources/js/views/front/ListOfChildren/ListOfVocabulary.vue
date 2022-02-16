<template>
  <div class="mb-0">
    <div v-if="vocabularyLetters == '/api/front/vocabulary'">
      <h4 class="vocabulary-letter text-decoration-none mb-0 font-weight-bold">{{ item.group }}</h4>
      <v-col class="subtitle-2 pa-0 font-weight-light">
        <vue-read-more-smooth :lines="15" no-shadow>
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
          <template v-slot:more="value">
            <div class="button-read-more">
              <span v-if="!value.open" class="toggle-button">
                <v-icon>mdi-chevron-down</v-icon>
              </span>
              <span v-else class="toggle-button">
                <v-icon>mdi-chevron-up</v-icon>
              </span>
            </div>
          </template>
        </vue-read-more-smooth>
      </v-col>
    </div>

    <div v-else>
      <vue-read-more-smooth :lines="15">
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
              <div v-html="child.body" style="overflow: hidden; max-height: 175px;"></div>
            </v-card>
          </a>
        </v-hover>
        <template v-slot:more="value">
          <div class="button-read-more">
            <span v-if="!value.open" class="toggle-button">
              <v-icon color="dark">mdi-chevron-down</v-icon>
            </span>
            <span v-else class="toggle-button">
              <v-icon>mdi-chevron-up</v-icon>
            </span>
          </div>
        </template>
      </vue-read-more-smooth>
    </div>
  </div>

</template>

<script>
import VueReadMoreSmooth from "vue-read-more-smooth";

export default {
  name: "ListOfChildren",
  props: ["item"],
  components: {VueReadMoreSmooth},
  data() {
    return {}
  },
  computed: {
    vocabularyLetters() {
      return '/api/front' + window.location.pathname;
    }
  }
}
</script>

<style scoped>
.vocabulary-body {
  position: absolute;
  background-color: #fff;
  margin-top: 3px;
  z-index: 1000;
}

.button-read-more {
  display: flex;
  justify-content: flex-end;
  font-size: 12px;
  font-style: italic;
  cursor: pointer;
  color: #232323 !important;
}

.vocabulary-letter {
  color: #494949;
  font-size: 20px;
  font-weight: bold;
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

<template>
  <v-col xl="5" lg="6" class="px-4" order="3" order-lg="2">
    <div v-if="category.slug">
      <h3 class="pt-4 pb-2">{{ category.name }}</h3>
      <p>{{ category.description }}</p>
    </div>
    <v-col v-else class="pa-0">
      <p>
        На сегодня содержит более одной тысячи основных терминов, соответствующих
        тематике сайта. Для удобства термины дополнительно разбиты на темы.
        Большинство терминов взяты из Википедии с указанием ссылки на источник. В
        большинстве понятий имеются другие взаимосвязанные термины и ссылки. По
        мере обновления на основном источнике здесь они будут равным образом
        обновляться.
      </p>
    </v-col>

    <v-col cols="12" class="d-flex align-items-center px-0">
      <div class="form-search rounded-lg w-100">
        <v-text-field
            solo
            flat
            dense
            clearable
            height="41"
            hide-details
            v-model="search"
            placeholder="Введите термин"
            background-color="transparent"
            @click:clear="clearVocabulary()"
            class="rounded-lg rounded-tr-0 rounded-br-0 search-filed"
        >
        </v-text-field>
        <v-btn
            depressed
            height="45"
            color="primary"
            class="text-capitalize rounded-0 rounded-br-lg rounded-tr-lg"
        >
          Поиск
        </v-btn>
      </div>
    </v-col>

    <v-row justify="center">

      <v-col
          v-for="(vocabulary, i) in filteredVocabulary"
          :key="i"
          class="fill-height col-md-6 col-12"
      >
        <v-lazy
            v-model="isActive"
            :options="{threshold: .1}"
            min-height="200"
            transition="fade-transition"
        >
          <v-card rounded="lg" class="px-7 py-5" flat>
            <v-card-text
                v-for="(term ,i) in vocabulary"
                :key="i"
                class="pa-1 pb-0"
            >
              <list-of-vocabulary :item="term"></list-of-vocabulary>
            </v-card-text>
          </v-card>
        </v-lazy>
      </v-col>

    </v-row>
  </v-col>
</template>

<script>
import ListOfVocabulary from "./ListOfChildren/ListOfVocabulary";
import InfiniteLoading from 'vue-infinite-loading';

export default {
  components: {
    ListOfVocabulary,
    InfiniteLoading
  },
  data() {
    return {
      isActive: false,
      search: "",
      terms: [],
      category: [],
      loading: false,
      page: 1,
      cols: 2,
    };
  },
  methods: {
    getVocabulary() {
      this.loading = true;
      let url = `/api/front${window.location.pathname}` ? `/api/front${window.location.pathname}` : '/api/front/vocabulary';

      axios
          .get(url)
          .then((res) => {
            this.loading = false;
            this.terms = res.data;

            if (res.data[0].slug) {
              this.category = res.data[0];
              this.terms = res.data[1];
            }
          })
          .catch((err) => {
            this.loading = false;
            console.log(err)
          })
    },
    clearVocabulary() {
      this.filteredVocabulary = this.terms
    }
  },
  mounted() {
    this.getVocabulary();
  },
  computed: {
    orderVocabulary() {
      let allTerms = this.terms.reduce((r, e) => {
        let group = e.name[0];
        if (!r[group]) r[group] = {group, children: [e]}
        else r[group].children.push(e);
        return r;
      }, {})
      return Object.values(allTerms);
    },
    columns() {
      let columns = [];
      let mid = Math.ceil(this.orderVocabulary.length / this.cols);
      for (let col = 0; col < this.cols; col++) {
        columns.push(this.orderVocabulary.slice(col * mid, col * mid + mid));
      }
      return columns;
    },
    filteredVocabulary: {
      get() {
        if (this.search) {
          return this.columns.map(terms => {
            return terms.map(term => {
              const children = term.children.filter(child => {
                return child.name.toLowerCase().includes(this.search.toLowerCase()) || this.search.includes(child.name)
              });
              return {...term, children}
            })
          });
        } else {
          return this.columns;
        }
      },
      set(v) {
        this.terms = v;
      }
    },
  },
};
</script>

<style scoped>
.form-search {
  display: flex;
}

.search-filed {
  border: 2px solid #9B9B9B;
  border-right: none;
}
</style>

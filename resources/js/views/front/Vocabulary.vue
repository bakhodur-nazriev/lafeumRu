<template>
  <v-col cols="5 px-5">
    <h5 class="text-uppercase font-weight-regular py-4">Словарь «ЛАФЕЮМ»</h5>
    <p class="grey--text">
      На сегодня содержит более одной тысячи основных терминов, соответствующих
      тематике сайта. Для удобства термины дополнительно разбиты на темы.
      Большинство терминов взяты из Википедии с указанием ссылки на источник. В
      большинстве понятий имеются другие взаимосвязанные термины и ссылки. По
      мере обновления на основном источнике здесь они будут равным образом
      обновляться.
    </p>

    <v-col cols="12" class="d-flex align-items-center pl-0 mb-8">
      <div class="form-search rounded-lg w-100">
        <v-text-field
          solo
          clearable
          height="52"
          hide-details
          placeholder="Область знаний"
          background-color="transparent"
          class="rounded-lg rounded-tr-0 rounded-br-0"
        >
        </v-text-field>
        <v-btn
          depressed
          height="52"
          color="primary"
          class="text-capitalize rounded-0"
        >
          Поиск
        </v-btn>
      </div>
    </v-col>
    <div class="mb-9">
      <h5 class="subtitle-1">
        Примеры информативных поисковых запросов: «нау», «логия», «ика», «изм»,
        «фило», «само», «чело», «соц», «пси», «эво» и т.п.
      </h5>
    </div>

    <h5 class="text-uppercase font-weight-regular">все слова</h5>
    <div class="row">
      <v-col cols="6 px-4">
        <v-card rounded="lg" flat height="250">
          <v-card-title v-for="(term ,i) in allTerms" :key="i">
            {{ term.name }}
          </v-card-title>
        </v-card>
      </v-col>

      <v-col class="text-center my-5">
        <v-btn large class="grey lighten-1" icon>
          <v-icon color="white">mdi-arrow-down</v-icon>
        </v-btn>
      </v-col>
    </div>
    <div class="text-center">
      <v-pagination v-model="page" :length="3"></v-pagination>
    </div>
  </v-col>
</template>

<script>
export default {
  props: ["terms"],
  data() {
    return {
      allTerms: this.terms,
      page: 1,
    };
  },
  created(){
    console.log(this.terms);
  }
};
</script>

<style scoped>
.form-search {
  display: flex;
  border: 2px solid #1a718c;
}
</style>

<template>
  <v-content class="pa-0">
    <v-container>
      <v-row justify="center">
        <v-col cols="6">
          <v-text-field
            class="mb-1"
            hide-details
            solo
            label="Поиск"
            append-icon="mdi-magnify"
            v-model="search"
          >
          </v-text-field>
        </v-col>
        <v-col cols="12">
          <v-data-table
            :headers="headers"
            :items="filteredTerms"
            :items-per-page="itemsPerPage"
            :page.sync="page"
            @page-count="pageCount = $event"
            hide-default-footer
            class="elevation-1"
          >
            <template v-slot:item.action="{ item }">
              <v-btn
                fab
                dark
                small
                color="primary"
                elevation="2"
                outlined
                @click="termToUpdate = { ...item }"
              >
                <v-icon dark>mdi-pen</v-icon>
              </v-btn>
              <v-btn
                fab
                dark
                small
                color="primary"
                elevation="2"
                outlined
                @click="termToShow = item"
              >
                <v-icon dark>mdi-file-eye-outline</v-icon>
              </v-btn>
              <v-btn
                fab
                dark
                small
                color="error"
                elevation="2"
                outlined
                @click="termToDelete = item"
              >
                <v-icon dark>
                  mdi-delete
                </v-icon>
              </v-btn>
            </template>
            <template v-slot:item.body="{ item }">
              <div v-html="item.body" class="short-paragraph" />
            </template>
          </v-data-table>
        </v-col>
        <div class="text-center pt-2">
          <v-pagination v-model="page" :length="pageCount"></v-pagination>
        </div>
      </v-row>
    </v-container>
    <v-tooltip top>
      <template v-slot:activator="{ on }">
        <v-btn
          bottom
          color="primary"
          v-on="on"
          dark
          fab
          fixed
          right
          @click="dialogAdd = !dialogAdd"
        >
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </template>
      <span>Добавить термин</span>
    </v-tooltip>

    <!-- Add Item Dialog -->
    <v-dialog v-model="dialogAdd" width="700px">
      <v-card>
        <v-card-title class="primary white--text">
          Создать Термин
        </v-card-title>
        <v-container>
          <v-row justify="center">
            <v-col cols="12">
              <v-text-field
                hide-details
                outlined
                v-model="termName"
                label="Добаить названия для термина здесь"
              >
              </v-text-field>
            </v-col>
            <v-col cols="12">
              <tiptap-vuetify
                outlined
                v-model="termBody"
                :extensions="extensions"
                placeholder="Добаить описания для термина здесь"
                :card-props="{ flat: true, color: '#21252921' }"
              >
              </tiptap-vuetify>
            </v-col>
          </v-row>
        </v-container>
        <v-card-actions>
          <v-spacer />
          <v-btn dark color="green" @click="addTerm()">Сохранить</v-btn>
          <v-btn dark color="error" @click="() => (dialogAdd = false)"
            >Отмена</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- Delete Item Dialog -->
    <v-dialog v-if="termToDelete" v-model="termToDelete" width="500">
      <v-card class="pa-2">
        <v-card-title class="pt-1 regular headline text-center"
          >Вы действительно хотите удалить это термин ?
        </v-card-title>
        <v-card-actions class="justify-center">
          <v-btn color="green darken-1" dark @click="termToDelete = false"
            >Нет
          </v-btn>
          <v-btn color="red darken-1" dark @click="deleteTerm()">Да</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- Update Item Dialog -->
    <v-dialog v-if="termToUpdate" v-model="termToUpdate" width="700px">
      <v-card>
        <v-card-title class="primary white--text">
          Изменить Термин
        </v-card-title>
        <v-container>
          <v-row justify="center">
            <v-col cols="12">
              <v-text-field
                hide-details
                outlined
                label="Изменить названия термина"
                v-model="termToUpdate.name"
              >
              </v-text-field>
            </v-col>
            <v-col cols="12">
              <tiptap-vuetify
                outlined
                name="body"
                :extensions="extensions"
                v-model="termToUpdate.body"
                placeholder="Изменить термин здесь"
              >
              </tiptap-vuetify>
            </v-col>
          </v-row>
        </v-container>
        <v-card-actions>
          <v-spacer />
          <v-btn dark color="green" @click="updateTerm()">Сохранить</v-btn>
          <v-btn dark color="error" @click="termToUpdate = false">Отмена</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    :style="'background: ' + project.backgroundChip"
    <!-- Show Quote Dialog -->
    <v-dialog v-if="termToShow" v-model="termToShow">
      <v-card class="mx-auto" max-width="344">
        <v-card-text>
          <div>Word of the Day</div>
          <p class="display-1 text--primary">
            be•nev•o•lent
          </p>
          <p>adjective</p>
          <div class="text--primary">
            well meaning and kindly.<br />
            "a benevolent smile"
          </div>
        </v-card-text>
        <v-card-actions>
          <v-btn text color="deep-purple accent-4">
            Learn More
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>


  </v-content>
</template>
<script>
import {
  // component
  TiptapVuetify,
  // extensions
  Heading,
  Bold,
  Italic,
  Strike,
  Underline,
  Paragraph,
  BulletList,
  OrderedList,
  ListItem,
  Link,
  Blockquote,
  HardBreak,
  HorizontalRule,
  History,
  Code
} from "tiptap-vuetify";

export default {
  components: { TiptapVuetify },
  data() {
    return {
      extensions: [
        History,
        Blockquote,
        Link,
        Underline,
        Strike,
        Italic,
        ListItem,
        BulletList,
        OrderedList,
        [
          Heading,
          {
            options: {
              levels: [1, 2, 3]
            }
          }
        ],
        Code,
        Bold,
        HorizontalRule,
        Paragraph,
        HardBreak
      ],
      valid: false,
      dialogAdd: false,
      dialogDelete: false,
      dialogUpdate: false,
      dialogShow: false,
      termName: "",
      termBody: "",
      terms: [],
      search: "",
      page: 1,
      pageCount: 2,
      itemsPerPage: 12,
      termToDelete: null,
      termToUpdate: null,
      termToShow: null,
      headers: [
        {
          text: "Название",
          value: "name",
          sortable: false
        },
        {
          text: "Термины",
          value: "body",
          sortable: false,
          class: "font-size: 20px"
        },
        {
          text: "Действия",
          value: "action",
          align: "center",
          sortable: false,
          width: "160px"
        }
      ]
    };
  },
  mounted() {
    this.loadTerms();
    console.log(this.loadTerms());
  },
  methods: {
    loadTerms() {
      axios
        .get("/api/terms")
        .then(res => {
          this.terms = res.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    addTerm() {
      axios
        .post("/api/terms/", {
          name: this.termName,
          body: this.termBody
        })
        .then(res => {
          this.loadTerms();
          this.dialogAdd = false;
        })
        .catch(err => {
          console.log(err);
        });
    },
    updateTerm() {
      axios
        .put("/api/terms/" + this.termToUpdate.id, {
          name: this.termToUpdate.name,
          body: this.termToUpdate.body
        })
        .then(res => {
          this.loadTerms();
          this.termToUpdate = false;
        })
        .catch(err => {
          console.log(err);
        });
    },
    deleteTerm() {
      axios
        .delete("/api/terms/" + this.termToDelete.id)
        .then(res => {
          this.loadTerms();
          this.termToDelete = false;
        })
        .catch(err => {
          console.log(err);
        });
    }
  },
  computed: {
    filteredTerms() {
      return this.terms.filter(term => {
        return term.body.toLowerCase().includes(this.search.toLowerCase());
      });
    }
  }
};
</script>

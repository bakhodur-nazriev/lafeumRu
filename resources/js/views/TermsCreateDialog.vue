<template>
    <v-dialog :value="value" width="700px" @input="$emit('input', false)">
        <v-card>
            <v-form ref="createForm" @submit="addTerm">
                <v-card-title class="primary white--text mb-5">
                    Создать Термин
                </v-card-title>
                <v-card-text>
                    <v-text-field
                        outlined
                        v-model="newTerm.name"
                        label="Введите название"
                        :rules="[rules.required]"
                    />
                    <v-text-field
                        outlined
                        v-model="newTerm.link"
                        label="Ссылка"
                    />
                    <v-select
                        v-model="newTerm.knowledgeAreas"
                        :items="knowledgeAreas"
                        outlined
                        multiple
                        item-value="id"
                        item-text="name"
                        label="Область знаний"
                        :rules="[rules.required]"
                    />
                    <v-select
                        v-model="newTerm.categories"
                        :items="categories"
                        outlined
                        multiple
                        item-value="id"
                        item-text="name"
                        label="Категории"
                        :rules="[rules.required]"
                    />
                    <v-checkbox
                        class="mt-0"
                        v-model="newTerm.show_in_vocabulary"
                        label="Показать в словаре"
                    />
                    <wysiwyg-editor
                        v-model="newTerm.body"
                        label="Введите описание"
                    />
                </v-card-text>
                <v-card-actions>
                    <v-spacer />
                    <v-btn dark color="green" type="submit">Сохранить </v-btn>
                    <v-btn
                        dark
                        color="error"
                        type="button"
                        @click="$emit('input', false)"
                        >Отмена
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
import WysiwygEditor from "../components/WysiwygEditor";
import rules from "../validation-rules";

export default {
    props: {
        value: Boolean,
        knowledgeAreas: Array,
        categories: Array
    },
    components: {
        "wysiwyg-editor": WysiwygEditor
    },
    data() {
        return {
            rules,
            newTerm: null
        };
    },
    beforeMount() {
        this.newTerm = this.getDefaultTerm();
    },
    methods: {
        getDefaultTerm() {
            return {
                name: "",
                body: "",
                link: "",
                knowledgeAreas: [],
                categories: [],
                show_in_vocabulary: false
            };
        },
        resetNewTerm() {
            this.newTerm = this.getDefaultTerm();
            this.$refs.createForm.reset();
        },
        addTerm(e) {
            e.preventDefault();

            this.$refs.createForm.validate();

            axios
                .post("/api/terms", this.newTerm)
                .then(res => {
                    this.resetNewTerm();
                    this.$emit("created", res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

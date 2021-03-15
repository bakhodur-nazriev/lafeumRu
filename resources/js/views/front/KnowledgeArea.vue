<template>
    <v-col cols="7 px-5">
        <h5 class="text-uppercase font-weight-regular py-4">Области знаний</h5>
        <p class="grey--text">В этой рубрике термины и комментарии специалистов классифицированы<br/> более развернуто
            по
            группам и направлениям.</p>
        <v-col cols="7" class="d-flex align-items-center pl-0 mb-11">
            <div class="form-search rounded-lg w-100">
                <v-text-field
                    solo
                    clearable
                    height="52"
                    hide-details
                    background-color="transparent"
                    placeholder="Область знаний"
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
        <v-card 
            flat
            :key="i"
            class="knowledge-area-card mb-9 pa-7"
            v-for="(knowledgeAreaParent, i) in knowledgeArea" 
        >
            <v-card-title class="d-flex flex-column">
                <div class="text-start w-100 mb-4">
                    <h2 class="display-1 font-weight-medium">
                        {{ knowledgeAreaParent.name }}
                    </h2>
                </div>
                <div class="col-12 list-col-4 px-0">
                    <v-card-text
                        :key="i"
                        class="pa-0 py-1"
                        v-for="(knowledgeArea, i) in knowledgeAreaParent.children"
                    >
                        <a :href="`/knowledge/` + knowledgeArea.slug">{{ knowledgeArea.name }}</a>
                    </v-card-text>
                </div>
            </v-card-title>
        </v-card>
    </v-col>
</template>

<script>
export default {
    name: "knowledgeArea",
    props: ["knowledgeArea"],

    data() {
        return {
            test: this.knowledgeArea
        }
    },
}
</script>

<style scoped>
.list-col-4{
    column-count: 3;
}
.form-search {
    display: flex;
    border: 2px solid #1a718c;
}
.knowledge-area-card{
    border-radius: 16px !important;
}
</style>

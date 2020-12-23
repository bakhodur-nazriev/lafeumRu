<template>
    <v-main class="pa-0">
        <index-page-layout
            ref="indexPage"
            search-field="name"
            index-url="/api/authors-trashed"
            add-label="Добавить автора"
            :table-headers="this.headers"
        >
            <template v-slot:item.biography="{ item }">
                <div
                    v-html="item.biography"
                    class="my-3 three-line-truncate"
                />
            </template>
            <template v-slot:item.photo="{ item }">
                <v-avatar size="78" class="ma-1" v-if="item.photo">
                    <v-img
                        :src="item.photo"
                        :alt="item.name"
                        max-width="6rem"
                    >
                    </v-img>
                </v-avatar>
            </template>
        </index-page-layout>

    </v-main>
</template>

<script>
import IndexPageLayout from "../../components/IndexPageLayout";

export default {
    components: {
        IndexPageLayout,
    },
    data() {
        return {
            authorGroups: [],
            authorToDelete: null,
            authorToUpdate: null,
            addAuthor: false,
            headers: [
                {
                    text: "Имя",
                    value: "name",
                    sortable: false
                },
                {
                    text: "Биография",
                    value: "biography",
                    sortable: false
                },
                {
                    text: "Фото",
                    value: "photo",
                    align: "center",
                    sortable: false
                },
            ]
        };
    },
    mounted() {
        this.loadAuthorGroups();
    },
    methods: {
        loadAuthorGroups() {
            axios
                .get("/api/author-groups")
                .then(res => (this.authorGroups = res.data))
                .catch(err => console.log(err));
        },
    }
}
</script>

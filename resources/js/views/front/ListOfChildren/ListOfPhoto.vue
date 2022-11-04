<template>
    <v-dialog
        v-model="photoDialog"
        width="900"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-card
                flat
                min-height="354"
                max-height="354"
                width="100%"
                class="pa-0 rounded"
            >
                <v-card-text
                    class="photo-content pa-0"
                    v-bind="attrs"
                    v-on="on"
                >
                    <v-col class="pb-2" v-if="photo.path && photo.title && photo.description">
                        <v-img height="205" :src="photo.path" class="rounded"></v-img>
                        <v-card-title class="photo-title truncate-to-one-line mb-1" v-if="photo.title">
                            {{ photo.title }}
                        </v-card-title>
                        <v-card-subtitle class="truncate-to-five-line">
                            {{ photo.description }}
                        </v-card-subtitle>
                    </v-col>
                    <v-col v-else>
                        <v-skeleton-loader
                            class="mx-auto"
                            max-width="300"
                            type="card, list-item-three-line"
                        ></v-skeleton-loader>
                    </v-col>
                </v-card-text>
            </v-card>
        </template>

        <v-card>
            <v-card-title class="title grey lighten-2 py-3 px-4">
                <v-spacer></v-spacer>
                <v-btn icon @click="photoDialog = false">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </v-card-title>

            <v-card-text class="pt-5">
                <v-img class="d-flex" :src="photo.path"></v-img>
                <v-col class="pa-0 text-left w-100">
                    <v-card-title class="photo-title px-0 mb-1" v-if="photo.title">{{ photo.title }}</v-card-title>
                    <v-card-subtitle class="px-0 pb-0">
                        {{ photo.description }}
                    </v-card-subtitle>
                </v-col>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: "ListOfPhoto",
    props: ["item"],
    data() {
        return {
            photoDialog: false,
            photo: this.item,
            theme: {
                default: {isDark: false},
            },
        }
    }
}
</script>

<style scoped>
.truncate-to-five-line {
    margin-top: 0;
    font-size: 13px;
    overflow: hidden;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    padding: 0;
}

.truncate-to-one-line {
    padding: 0;
    overflow: hidden;
    display: inherit;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.photo-content {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.photo-title {
    line-height: normal;
    word-break: break-word;
    text-align: justify;
}

.just-test .v-skeleton-loader__card-heading {
    display: none !important;
}
</style>

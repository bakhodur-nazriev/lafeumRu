<template>
    <v-dialog
        v-model="photoDialog"
        width="900"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-card
                flat
                rounded="lg"
                max-width="310"
                min-height="370"
                class="d-flex flex-column justify-content-between pa-3"
            >
                <v-card-text
                    class="photo-content"
                    v-bind="attrs"
                    v-on="on"
                >
                    <v-img
                        min-height="175"
                        max-height="175"
                        class="d-flex"
                        :src="photo.path"
                    ></v-img>
                    <div class="text-left w-100">
                        <v-card-title class="photo-title truncate-to-one-line mt-2">
                            {{photo.title}}
                        </v-card-title>
                        <v-card-subtitle class="px-0 pb-0 mt-1 truncate-to-four-line">
                            {{ photo.description }}
                        </v-card-subtitle>
                    </div>
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
                <v-img
                    class="d-flex"
                    :src="photo.path"
                ></v-img>
                <div class="text-left w-100">
                    <v-card-title class="photo-title px-0 mb-1">{{ photo.title }}</v-card-title>
                    <v-card-subtitle class="px-0 pb-0 truncate-to-four-line">
                        {{ photo.description }}
                    </v-card-subtitle>
                </div>
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
            photo: this.item
        }
    }
}
</script>

<style scoped>
.truncate-to-four-line {
    padding: 0;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
}

.truncate-to-one-line {
    padding: 0;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
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
}
</style>

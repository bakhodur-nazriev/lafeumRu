<template>
    <v-card
        flat
        rounded="lg"
        max-width="315"
        min-height="370"
        class="d-flex flex-column justify-content-between pa-3"
    >
        <v-card-text class="photo-content">
            <v-img min-height="150" class="d-flex" :src="photo.path"></v-img>
            <div class="text-left w-100">
                <v-card-title class="photo-title px-0 mb-1">{{ photo.title }}</v-card-title>
                <v-card-subtitle class="px-0 pb-0 truncate-to-four-line">
                    {{ photo.description }}
                </v-card-subtitle>
            </div>
        </v-card-text>
    </v-card>
    <!--    <v-dialog
            v-model="dialog"
            width="800"
        >
            <template v-slot:activator="{ on }">
                <v-card
                    flat
                    v-on="on"
                    rounded="lg"
                    max-width="315"
                    min-height="370"
                    class="d-flex flex-column justify-content-between pa-3"
                >
                    <v-card-text class="photo-content">
                        <v-img class="d-flex" :src="photo.path"></v-img>
                        <div>
                            <v-card-title class="photo-title px-0 mb-1">{{ photo.title }}</v-card-title>
                            <v-card-subtitle class="px-0 pb-0 truncate-to-four-line">
                                {{ photo.description }}
                            </v-card-subtitle>
                        </div>
                    </v-card-text>
                </v-card>
            </template>
            <v-card
                flat
                rounded="lg"
                class="d-flex flex-column justify-content-between pa-3"
            >
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        icon
                        color="primary"
                        @click="dialog = false"
                    >
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-card-actions>

                <v-card-text class="px-4">
                    <v-img class="d-flex" :src="photo.path"></v-img>
                    <div>
                        <v-card-title class="px-0 mb-1">{{ photo.title }}</v-card-title>
                        <v-card-subtitle class="px-0 pb-0">
                            {{ photo.description }}
                        </v-card-subtitle>
                    </div>
                </v-card-text>
            </v-card>
        </v-dialog>-->
</template>

<script>
export default {
    name: "ListOfPhoto",
    props: ["item"],
    data() {
        return {
            dialog: false,
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

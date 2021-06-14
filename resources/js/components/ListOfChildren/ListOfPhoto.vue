<template>
    <v-card
        flat
        rounded="lg"
        max-width="315"
        min-height="370"
        class="d-flex flex-column justify-content-between pa-3"
    >
        <v-card-text class="photo-content">
            <v-img min-height="175" max-height="175" class="d-flex" :src="photo.path"></v-img>
            <div class="text-left w-100">
                <v-card-title class="photo-title px-0 mb-1">{{ photo.title }}</v-card-title>
                <v-card-subtitle class="px-0 pb-0 truncate-to-four-line">
                    {{ photo.description }}
                </v-card-subtitle>
            </div>
        </v-card-text>
    </v-card>
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

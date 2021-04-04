<template>
    <div>
        <v-card
            rounded="lg"
            flat class="mb-8"
        >
            <v-card-subtitle class="d-flex p-4">
                <v-spacer></v-spacer>
                <a
                    class="grey--text text-decoration-none"
                    href="#"
                >
                    #123564
                </a>
            </v-card-subtitle>

            <v-divider class="m-0 grey lighten-3"></v-divider>

            <v-card-text class="p-4">
                <p class="subtitle-1"></p>
                <div class="mb-2">
                    <a class="d-flex align-items-center text-decoration-none" href="#">
                        <v-icon color="grey lighten-1">mdi-account</v-icon>
                        <h5 class="mb-0 ml-1 black--text subtitle-1">Ovaev nea</h5>
                    </a>
                </div>
                <div class="categories-block">
                    <a
                        class="mx-1 grey--text text-decoration-none"
                        href=""
                    >
                        Just Test
                    </a>
                </div>
            </v-card-text>

            <v-divider class="m-0 grey lighten-3"></v-divider>

            <v-card-actions class="px-5 py-4">
                <div v-for="(quoteAction ,i) in quoteActions" :key="i">
                    <v-btn icon>
                        <v-icon color="grey lighten-1">{{ quoteAction.icon }}</v-icon>
                    </v-btn>
                    <span>{{ quoteAction.count }}</span>
                </div>
                <v-spacer></v-spacer>
                <div>
                    <v-btn icon color="grey lighten-1">
                        <v-icon>mdi-share-variant</v-icon>
                    </v-btn>
                </div>
            </v-card-actions>

            <v-divider class="m-0 grey lighten-3"></v-divider>

            <v-card-text class="d-flex align-items-center p-4">
                <v-avatar size="50">
                    <img src="https://cdn.vuetifyjs.com/images/john.jpg">
                </v-avatar>
                <v-text-field
                    dense
                    filled
                    rounded
                    clearable
                    hide-details
                    class="rounded-lg ml-5"
                    label="Напишите комментарий..."
                />
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
export default {
    data() {
        return {
            quoteActions: [
                {
                    icon: "mdi-heart",
                    count: 45
                },
                {
                    icon: "mdi-bookmark",
                    count: 87
                },
                {
                    icon: "mdi-message-reply-text",
                    count: 52
                }
            ],
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <div>
        <v-card rounded="lg" flat v-for="i in 3" :key="i" class="mb-8">
            <v-card-subtitle class="d-flex p-4">
                <v-spacer></v-spacer>
                <a class="grey--text text-decoration-none" href="#">#12345</a>
            </v-card-subtitle>

            <v-divider class="m-0 b"></v-divider>

            <v-card-text class="p-4">
                <p class="subtitle-1">Законы математики, имеющие какое-либо отношение к реальному миру, ненадёжны; а
                    надёжные
                    математические законы не имеют отношения к реальному миру.</p>
                <div class="mb-2">
                    <a class="d-flex align-items-center text-decoration-none" href="#">
                        <v-icon color="grey lighten-1">mdi-account</v-icon>
                        <h5 class="mb-0 ml-1 black--text">Альберт Эйнштейн</h5>
                    </a>
                </div>
                <div class="categories-block">
                    <a href="#" class="mx-1 grey--text text-decoration-none">Достижения</a>
                    <a href="#" class="mx-1 grey--text text-decoration-none">Эрудиция</a>
                    <a href="#" class="mx-1 grey--text text-decoration-none">Компетентность</a>
                </div>
            </v-card-text>

            <v-divider class="m-0"></v-divider>

            <v-card-actions class="p-4">
                <div>
                    <v-btn icon color="grey lighten-1">
                        <v-icon color="red">mdi-heart</v-icon>
                    </v-btn>
                    <span class="grey--text lighten-1">44</span>
                    <v-btn icon color="grey lighten-1">
                        <v-icon>mdi-bookmark</v-icon>
                    </v-btn>
                    <span class="grey--text lighten-1">13</span>
                    <v-btn icon color="grey lighten-1">
                        <v-icon>mdi-message-reply-text</v-icon>
                    </v-btn>
                    <span class="grey--text lighten-1">3</span>
                </div>
                <v-spacer></v-spacer>
                <div>
                    <v-btn icon color="grey lighten-1">
                        <v-icon>mdi-share-variant</v-icon>
                    </v-btn>
                    <span></span>
                </div>
            </v-card-actions>

            <v-divider class="m-0"></v-divider>

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
        return {}
    }
}
</script>

<style scoped>

</style>

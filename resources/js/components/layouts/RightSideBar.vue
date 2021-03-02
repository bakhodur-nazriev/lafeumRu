<template>
    <v-col>
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">Рекоммендуемые</h5>
        <v-card class="rounded-lg pa-2" flat>
            <!-- Quote Section -->
            <v-card-title class="subtitle-2 font-weight-bold">Цитата дня</v-card-title>
            <v-divider class="ma-0"></v-divider>

            <v-card-title class="subtitle-2 font-weight-bold">{{ quote.author.name }}<br/> Категория: Цитата дня
            </v-card-title>
            <v-card-text>{{ quote.body }}</v-card-text>

            <v-card-actions class="justify-content-end">
                <a href="/quotes" class="font-italic">еще.</a>
            </v-card-actions>

            <!-- Term Section -->
            <v-card-title class="subtitle-2 font-weight-bold">Термин дня</v-card-title>
            <v-divider class="ma-0"></v-divider>
            <v-card-text class="truncate-to-five-line">
                {{ term.body }}
            </v-card-text>
            <v-card-actions class="justify-content-end">
                <a href="/terms" class="font-italic">еще.</a>
            </v-card-actions>

            <!-- Video section -->
            <v-card-title class="subtitle-2 font-weight-bold">Видео дня</v-card-title>
            <v-divider class="ma-0"></v-divider>

            <v-card-title class="subtitle-2 font-weight-bold">{{ video.title }}</v-card-title>
            <v-card-text></v-card-text>
            <v-card-actions class="justify-content-end">
                <a href="/videos" class="font-italic">еще.</a>
            </v-card-actions>

            <!-- Photo Section -->
            <v-card-title class="subtitle-2 font-weight-bold">Фото дня</v-card-title>
            <v-divider class="ma-0"></v-divider>
            <v-card-text>
                <v-img
                    :src="photo.path"
                    :alt="photo.description"
                    max-height="150"
                    max-width="225"
                ></v-img>
            </v-card-text>
            <v-card-actions class="justify-content-end">
                <a href="/photos" class="font-italic">еще.</a>
            </v-card-actions>
        </v-card>
    </v-col>
</template>

<script>
export default {
    name: "RightSideBar",
    props: ["dailyPosts"],
    data() {
        return {
            quote: this.dailyPosts.quote,
            term: this.dailyPosts.term,
            video: this.dailyPosts.video,
            photo: this.dailyPosts.photo,
        }
    },
    mounted() {
        console.log(this.quote.author.name);
    }
}
</script>

<style scoped>
.truncate-to-five-line {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}
</style>

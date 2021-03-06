<template>
    <v-col cols="5">
        <h5 class="text-uppercase font-weight-regular py-4">Цитаты</h5>
        <v-card rounded="lg" flat>
            <v-card-subtitle class="d-flex">
                <v-spacer></v-spacer>
                <a class="grey--text text-decoration-none" href="#">#12345</a>
            </v-card-subtitle>

            <v-divider></v-divider>

            <v-card-text>
                <p>Законы математики, имеющие какое-либо отношение к реальному миру, ненадёжны; а надёжные
                    математические законы не имеют отношения к реальному миру.</p>
                <div class="d-flex align-items-center">
                    <v-icon color="grey">mdi-account</v-icon>
                    <h5 class="mb-0 black--text">Альберт Эйнштейн</h5>
                </div>
                <div>
                    <a href="#">Достижения</a>
                    <a href="#">Эрудиция</a>
                    <a href="#">Компетентность</a>
                </div>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
                <div>
                    <v-btn icon>
                        <v-icon color="red">mdi-heart</v-icon>
                    </v-btn>
                    <span>44</span>
                    <v-btn icon>
                        <v-icon>mdi-bookmark</v-icon>
                    </v-btn>
                    <span>13</span>
                    <v-btn icon>
                        <v-icon>mdi-message-reply-text</v-icon>
                    </v-btn>
                    <span>3</span>
                </div>
                <v-spacer></v-spacer>
                <div>
                    <v-btn icon>
                        <v-icon>mdi-share-variant</v-icon>
                    </v-btn>
                    <span></span>
                </div>
            </v-card-actions>

            <v-divider></v-divider>

            <v-card-text class="d-flex align-items-center">
                <v-avatar>
                    <img src="https://cdn.vuetifyjs.com/images/john.jpg">
                </v-avatar>
                <v-text-field
                    dense
                    filled
                    rounded
                    clearable
                    hide-details
                    height="37"
                    class="rounded-lg ml-2"
                    placeholder="Напишите комментарий..."
                />
            </v-card-text>
        </v-card>
    </v-col>
</template>

<script>
export default {
    name: "Quotes",
    props: ["quotes"],
    data() {
        return {
            allQuotes: this.quotes
        };
    }
};
</script>

<style scoped>
.id-link {
    color: #A3A3A3
}
</style>

<template>
    <v-footer
        app
        bottom
        padless
        absolute
    >
        <v-card
            flat
            tile
            width="100%"
            height="256"
        >
            <v-card-text class="text-center">
                <div class="d-flex justify-content-center">
                    <v-img
                        max-width="88"
                        src="/img/white-footer-logo.png"
                    >
                    </v-img>
                </div>
                <v-btn
                    v-for="link in links"
                    :key="link"
                    class="text-white"
                    text
                >
                    {{ link.name }}
                </v-btn>
            </v-card-text>

            <v-divider class="bg-white"></v-divider>

            <v-card-text class="d-flex justify-content-around align-items-center">
                <span class="text-white">© 2017 - {{ new Date().getFullYear() }} — Lafeum. Все права защищены.</span>
                <v-div>
                    <v-btn
                        fab
                        icon
                        small
                        depressed
                        class="mx-2"
                        color="primary"
                    >
                        <v-icon dark>
                            mdi-instagram
                        </v-icon>
                    </v-btn>
                    <v-btn
                        fab
                        icon
                        small
                        depressed
                        class="mx-2"
                        color="primary"
                    >
                        <v-icon>
                            mdi-basketball
                        </v-icon>
                    </v-btn>
                    <v-btn
                        fab
                        icon
                        small
                        depressed
                        class="mx-2"
                    >
                        <v-icon color="text-primary">
                            mdi-twitter
                        </v-icon>
                    </v-btn>
                    <v-btn
                        fab
                        icon
                        small
                        depressed
                        class="mx-2"
                        color="primary"
                    >
                        <v-icon>
                            mdi-youtube
                        </v-icon>
                    </v-btn>
                </v-div>
            </v-card-text>
        </v-card>
    </v-footer>
</template>
<script>
export default {
    name: "FrontBack",
    data() {
        return {
            links: [
                {
                    name: "О сайте",
                    href: "/about-us"
                },
                {
                    name: "Контакты",
                    href: "/contacts"
                },
                {
                    name: "Политика конфиденциальности",
                    href: "/privacy-policy"
                },
                {
                    name: "Пользовательское соглашение",
                    href: "/terms-of-use"
                }
            ]
        }
    }
}
</script>

<style scoped>

</style>

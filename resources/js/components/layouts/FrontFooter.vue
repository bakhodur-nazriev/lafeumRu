<template>
    <v-footer
        app
        padless
        absolute
    >
        <v-card
            flat
            tile
            width="100%"
            height="256"
            class="primary"
        >
            <v-card-text class="d-flex flex-column align-center">
                <div class="mb-3">
                    <v-img
                        max-width="88"
                        src="/img/white-footer-logo.png"
                    >
                    </v-img>
                </div>
                <div>
                    <a
                        class="navbar-links mx-3"
                        v-for="link in links"
                        :href="link.href"
                        :key="link.href"
                    >
                        {{ link.name }}
                    </a>
                </div>
            </v-card-text>

            <v-divider class="bg-white mx-10" ></v-divider>

            <v-card-text class="d-flex justify-content-around align-items-center">
                <span class="text-white">© 2017 - {{ new Date().getFullYear() }} — Lafeum. Все права защищены.</span>
                <div>
                    <v-btn
                        fab
                        icon
                        small
                        depressed
                        class="mx-2"
                        color="primary lighten-1"
                    >
                        <v-icon color="white">
                            mdi-instagram
                        </v-icon>
                    </v-btn>
                    <v-btn
                        fab
                        icon
                        small
                        depressed
                        class="mx-2"
                        color="primary lighten-1"
                    >
                        <v-icon color="white">
                            mdi-basketball
                        </v-icon>
                    </v-btn>
                    <v-btn
                        fab
                        icon
                        small
                        depressed
                        class="mx-2"
                        color="primary lighten-1"
                    >
                        <v-icon color="white">
                            mdi-twitter
                        </v-icon>
                    </v-btn>
                    <v-btn
                        fab
                        icon
                        small
                        depressed
                        class="mx-2"
                        color="primary lighten-1"
                    >
                        <v-icon color="white">
                            mdi-youtube
                        </v-icon>
                    </v-btn>
                </div>
            </v-card-text>
        </v-card>
    </v-footer>
</template>
<script>
export default {
    name: "FrontFooter",
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
.navbar-links {
    font-size: 14px;
    font-weight: 500;
    color: #fff;
}

.navbar-links:hover {
    text-decoration: none;
    color: #A4C2FF;
}
</style>


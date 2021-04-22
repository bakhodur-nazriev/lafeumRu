<template>
    <v-footer
        padless
        color="primary"
    >
        <v-row>
            <v-col cols="12">
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
                            :key="link.id"
                        >
                            {{ link.name }}
                        </a>
                    </div>
                </v-card-text>
            </v-col>
            <v-row justify="center">
                <v-col cols="8" class="py-0">
                    <v-divider class="footer-divider grey lighten-5 my-0 mr-9 ml-8"></v-divider>
                </v-col>
            </v-row>
            
            <v-col cols="12">
                <v-card-text class="d-flex justify-content-around align-items-center">
                    <span class="text-white">© 2017 - {{
                            new Date().getFullYear()
                        }} — Lafeum. Все права защищены.</span>
                    <div>
                        <v-btn
                            fab
                            icon
                            small
                            depressed
                            class="primary lighten-1 mx-2"
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
                            class="primary lighten-1 mx-2"
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
                            class="primary lighten-1 mx-2"
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
                            class="primary lighten-1 mx-2"
                        >
                            <v-icon color="white">
                                mdi-youtube
                            </v-icon>
                        </v-btn>
                    </div>
                </v-card-text>
            </v-col>
        </v-row>
    </v-footer>
</template>
<script>
export default {
    name: "FrontFooter",
    data() {
        return {
            links: [
                {
                    id: 1,
                    name: "О сайте",
                    href: "/about-us"
                },
                {
                    id: 2,
                    name: "Контакты",
                    href: "/contacts"
                },
                {
                    id: 3,
                    name: "Политика конфиденциальности",
                    href: "/privacy-policy"
                },
                {
                    id: 4,
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

.footer-divider {
    min-height: 1px;
}
</style>


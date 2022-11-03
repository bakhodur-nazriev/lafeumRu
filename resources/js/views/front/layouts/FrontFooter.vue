<template>
    <v-footer color="primary">
        <v-row justify="center">
            <v-col class="col-12 d-flex justify-center">
                <v-img
                    max-width="88"
                    src="/img/white-footer-logo.png"
                >
                </v-img>
            </v-col>
            <v-col class="col-12 text-break d-inline text-center">
                <a
                    class="navbar-links mx-3"
                    v-for="link in links"
                    :href="link.href"
                    :key="link.id"
                >
                    {{ link.name }}
                </a>
            </v-col>
            <v-col class="col-lg-6 col-12 d-flex justify-center">
                <v-divider class="footer-divider grey lighten-5 my-0"></v-divider>
            </v-col>
            <v-col class="text-white col-12 d-flex justify-center pb-0">
                © 2017 - {{ new Date().getFullYear() }} — Lafeum. Все права защищены.
            </v-col>
            <v-col class="col-12 col-md-6 d-flex justify-center py-6">
                <v-btn
                    fab
                    icon
                    small
                    depressed
                    target="_blank"
                    href="https://vk.com/club209177677"
                    class="primary lighten-1 mx-2 text-decoration-none"
                >
                    <v-icon color="white">
                        mdi-vk
                    </v-icon>

                </v-btn>
                <v-btn
                    fab
                    icon
                    small
                    depressed
                    target="_blank"
                    href="https://t.me/lafeum_ru"
                    class="primary lighten-1 mx-2 text-decoration-none"
                >
                    <v-icon color="white">
                        mdi-telegram
                    </v-icon>
                </v-btn>
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


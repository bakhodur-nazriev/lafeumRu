<template>
    <v-footer
        color="primary"
        padless
    >
        <v-row
            justify="center"
            no-gutters
        >
            <v-btn
                v-for="link in links"
                :key="link.url"
                color="white"
                text
                class="my-2"
                :href="link.url"
            >
                {{ link.name }}
            </v-btn>
            <v-col
                class="primary  py-4 text-center white--text"
                cols="12"
            >
                <v-row justify="center">
                    <v-col cols="1">
                        <v-img src="img/white-footer-logo.png" width="140"></v-img>
                    </v-col>
                </v-row>
                {{ new Date().getFullYear() }} — &copy; Lafeum.<strong> Все права защищены.</strong>
            </v-col>
        </v-row>
    </v-footer>
</template>


<script>
    export default {
        data() {
            return {
                links: [
                    {
                        name: 'Главная',
                        url: '/'
                    },
                    {
                        name: 'Авторы',
                        url: '/authors'
                    },
                    {
                        name: 'Термины',
                        url: '/terms'
                    },
                    {
                        name: 'Словарь',
                        url: '/vocabulary'
                    },
                    {
                        name: 'Области Знаний',
                        url: '/knowledges'
                    },
                    {
                        name: 'Видео',
                        url: '/videos'
                    },
                    {
                        name: 'Каналы',
                        url: '/channels'
                    },
                    {
                        name: 'Фотографии',
                        url: '/photos'
                    },
                    {
                        name: 'Контакты',
                        url: '/contacts'
                    }
                ],
            }
        },
    }
</script>

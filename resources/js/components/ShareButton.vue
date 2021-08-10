<template>
    <div class="d-flex align-center">
        <v-expand-transition>
            <div v-show="expand">
                <Vkontakte :url="`${appUrl}/` + postLink.id" class="share-button--circle" btnText/>
                <Facebook :url="`${appUrl}/` + postLink.id" class="share-button--circle" btnText/>
                <Odnoklassniki :url="`${appUrl}/` + postLink.id" class="share-button--circle" btnText/>
                <Twitter :url="`${appUrl}/` + postLink.id" class="share-button--circle" btnText/>
                <viber :url="`${appUrl}/` + postLink.id" class="share-button--circle" btnText/>
                <WhatsApp :url="`${appUrl}/` + postLink.id" class="share-button--circle" btnText/>
                <Telegram :url="`${appUrl}/` + postLink.id" class="share-button--circle" btnText/>
            </div>
        </v-expand-transition>
        <v-btn icon color="grey lighten-1" @click="expand = !expand">
            <v-icon>mdi-share-variant</v-icon>
        </v-btn>
    </div>
</template>

<script>
import Vkontakte from "vue-share-buttons/src/components/VkontakteButton"
import Facebook from "vue-share-buttons/src/components/FacebookButton"
import Odnoklassniki from "vue-share-buttons/src/components/OdnoklassnikiButton"
import Twitter from "vue-share-buttons/src/components/TwitterButton"
import Viber from "vue-share-buttons/src/components/ViberButton"
import WhatsApp from "vue-share-buttons/src/components/WhatsAppButton"
import Telegram from "vue-share-buttons/src/components/TelegramButton"

export default {
    props: ["post"],
    name: "ShareButton",
    components: {
        Vkontakte,
        Facebook,
        Odnoklassniki,
        Twitter,
        Viber,
        WhatsApp,
        Telegram
    },
    data() {
        return {
            postLink: this.post,
            expand: false,
            appUrl: process.env.MIX_APP_URL,
        }
    },
    mounted() {
        document.querySelectorAll('.share-button').forEach(el => {
            el.style.padding = "0px"
            el.style.minWidth = "25px"
            el.style.minHeight = "25px"
            el.style.margin = "1px"
        });

        document.querySelectorAll(".share-button__icon").forEach(el => {
            el.style.maxWidth = "14px"
            el.style.maxHeight = "14px"
        })
    },
}
</script>

<style scoped>

</style>

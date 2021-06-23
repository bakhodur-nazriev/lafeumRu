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
    updated() {
        document.querySelector('.share-button__icon[data-v-7db37067]').setAttribute('width', '16');
        document.querySelector('.share-button__icon[data-v-8d0542ae]').setAttribute('width', '16');
        document.querySelector('.share-button__icon[data-v-cbff2028]').setAttribute('width', '16');
        document.querySelector('.share-button__icon[data-v-32004731]').setAttribute('width', '16');
        document.querySelector('.share-button__icon[data-v-79361461]').setAttribute('width', '16');
        document.querySelector('.share-button__icon[data-v-519b00aa]').setAttribute('width', '16');
        document.querySelector('.share-button__icon[data-v-71655f98]').setAttribute('width', '16');
    },
}
</script>

<style scoped>
.share-button--circle[data-v-7db37067],
.share-button--circle[data-v-8d0542ae],
.share-button--circle[data-v-cbff2028],
.share-button--circle[data-v-32004731],
.share-button--circle[data-v-79361461],
.share-button--circle[data-v-519b00aa],
.share-button--circle[data-v-71655f98] {
    margin: 1px;
    padding: 0;
    min-width: 28px;
    min-height: 28px;
}

</style>

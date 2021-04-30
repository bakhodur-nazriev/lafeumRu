<template>
    <div class="d-flex align-center">
        <v-expand-transition>
            <div v-show="expand">
                <div v-if="postLink.postable_type == 'App\\Term'">
                    <Vkontakte :url="`/terms/` + postLink.id" class="share-button--circle" btnText/>
                    <Facebook :url="`/terms/` + postLink.id" class="share-button--circle" btnText/>
                    <Odnoklassniki :url="`/terms/` + postLink.id" class="share-button--circle" btnText/>
                    <Twitter :url="`/terms/` + postLink.id" class="share-button--circle" btnText/>
                    <viber :url="`/terms/` + postLink.id" class="share-button--circle" btnText/>
                    <WhatsApp :url="`/terms/` + postLink.id" class="share-button--circle" btnText/>
                    <Telegram :url="`/terms/` + postLink.id" class="share-button--circle" btnText/>
                </div>
                <div v-if="postLink.postable_type == 'App\\Video'">
                    <Vkontakte :url="`/video/` + postLink.id" class="share-button--circle" btnText/>
                    <Facebook :url="`/video/` + postLink.id" class="share-button--circle" btnText/>
                    <Odnoklassniki :url="`/video/` + postLink.id" class="share-button--circle" btnText/>
                    <Twitter :url="`/video/` + postLink.id" class="share-button--circle" btnText/>
                    <viber :url="`/video/` + postLink.id" class="share-button--circle" btnText/>
                    <WhatsApp :url="`/video/` + postLink.id" class="share-button--circle" btnText/>
                    <Telegram :url="`/video/` + postLink.id" class="share-button--circle" btnText/>
                </div>
            </div>
        </v-expand-transition>
        <div v-if="postLink.postable_type == 'App\\Quote'">
            <Vkontakte :url="`/quotes/` + postLink.id" class="share-button--circle" btnText/>
            <Facebook :url="`/quotes/` + postLink.id" class="share-button--circle" btnText/>
            <Odnoklassniki :url="`/quotes/` + postLink.id" class="share-button--circle" btnText/>
            <Twitter :url="`/quotes/` + postLink.id" class="share-button--circle" btnText/>
            <viber :url="`/quotes/` + postLink.id" class="share-button--circle" btnText/>
            <WhatsApp :url="`/quotes/` + postLink.id" class="share-button--circle" btnText/>
            <Telegram :url="`/quotes/` + postLink.id" class="share-button--circle" btnText/>
        </div>

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
            expand: false
        }
    },
    create() {
        console.log(this.postLink);
    }
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
    padding: 0;
    min-width: 34px;
    min-height: 34px;
}

.share-button__icon[data-v-7db37067],
.share-button__icon[data-v-71655f98],
.share-button__icon[data-v-519b00aa],
.share-button__icon[data-v-79361461],
.share-button__icon[data-v-32004731],
.share-button__icon[data-v-cbff2028],
.share-button__icon[data-v-8d0542ae] {
    width: 10px;
}
</style>

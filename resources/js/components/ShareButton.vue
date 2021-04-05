<template>
    <div>
        <Telegram :url="quote.post.id" class="share-button--circle" btnText/>
        <Facebook :url="quote.post.id" class="share-button--circle" btnText/>
        <Odnoklassniki :url="quote.post.id" class="share-button--circle" btnText/>
        <Twitter :url="quote.post.id" class="share-button--circle" btnText/>
        <viber :url="quote.post.id" class="share-button--circle" btnText/>
        <WhatsApp :url="quote.post.id" class="share-button--circle" btnText/>
        <Telegram :url="quote.post.id" class="share-button--circle" btnText/>
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
    name: "ShareButton",
    components: {
        Vkontakte,
        Facebook,
        Odnoklassniki,
        Twitter,
        Viber,
        WhatsApp,
        Telegram
    }
}
</script>

<style scoped>

</style>

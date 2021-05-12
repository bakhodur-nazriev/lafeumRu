// import {req} from "vuelidate/lib/validators/common";

require("./constants");

import Vue from "vue";
import Vuetify from "vuetify";
import Vuelidate from "vuelidate"
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";
import frontApp from "./components/frontApp";
import backApp from "./components/backApp";
import router from "./router.js";
import ru from 'vuetify/es5/locale/ru'
import Embed from 'v-video-embed'
import VueScrollTo from 'vue-scrollto'

require("./bootstrap");
window.Vue = require("vue");

const vuetifyOptions = {
    icons: {
        iconfont: "mdi"
    },
    theme: {
        themes: {
            light: {
                secondary: "#21353f",
                primary: "#04718c",
                error: "#EF5350",
                headary: "#a6192e"
            }
        }
    },
    lang: {
        locales: {
            ru
        },
        current: "ru" // en | es | fr | pl | ru
    }
};

window.Event = new (class {
    constructor() {
        this.vue = new Vue();
    }

    fire(event, data = null) {
        this.vue.$emit(event, data);
    }

    listen(event, callback) {
        this.vue.$on(event, callback);
    }
})();

Vue.use("draggable");
Vue.use(Vuetify);
Vue.use(Vuelidate);
Vue.use(Embed);
Vue.use(VueScrollTo)

// You can also pass in the default options
Vue.use(VueScrollTo, {
    container: "body",
    duration: 500,
    easing: "ease",
    offset: 0,
    force: true,
    cancelable: true,
    onStart: false,
    onDone: false,
    onCancel: false,
    x: false,
    y: true
})

Vue.component("default", require("./views/front/Default").default);
Vue.component("home", require("./views/front/Home").default);
Vue.component("quotes", require("./views/front/Quotes").default);
Vue.component("terms", require("./views/front/Terms").default);
Vue.component("videos", require("./views/front/Videos").default);
Vue.component("photos", require("./views/front/Photos").default);
Vue.component("authors", require("./views/front/Authors").default);
Vue.component("knowledge-area", require("./views/front/KnowledgeArea").default);
Vue.component("vocabulary", require("./views/front/Vocabulary").default);
Vue.component("channels", require("./views/front/Channels").default);
Vue.component("front-navbar", require("./components/layouts/FrontNavbar").default);
Vue.component("front-footer", require("./components/layouts/FrontFooter").default);
Vue.component("privacy-policy", require("./views/front/PrivacyPolicy").default);
Vue.component("terms-of-use", require("./views/front/TermsOfUse").default);
Vue.component("about-us", require("./views/front/AboutUs").default);

/* Shows */
Vue.component("category", require("./views/front/shows/Category").default);
Vue.component("author-show", require("./views/front/shows/Author").default);
Vue.component("knowledge", require("./views/front/shows/KnowledgeArea").default);
Vue.component("channel-show", require("./views/front/shows/Channel").default);
Vue.component("post-show", require("./views/front/shows/Post.vue").default);

/* Login */
Vue.component("login", require("./views/LoginPage").default);
Vue.component("register", require("./views/RegisterPage").default);

/* Contacts */
Vue.component("contacts", require("./views/front/Contacts").default);

/* Layouts */
Vue.component("quote-item", require("./views/front/layouts/QuoteItem").default);
Vue.component("term-item", require("./views/front/layouts/TermItem").default);
Vue.component("video-item", require("./views/front/layouts/VideoItem").default);
Vue.component("photo-item", require("./views/front/layouts/PhotoItem").default);

/* Left Side Bar */
Vue.component("left-side-bar", require("./components/layouts/LeftSideBar").default);
Vue.component("home-left-sidebar", require("./components/layouts/HomeLeftSideBar").default);
Vue.component("authors-left-sidebar", require("./components/layouts/AuthorsLeftSideBar").default);
Vue.component("channels-left-sidebar", require("./components/layouts/ChannelsLeftSideBar").default);
Vue.component("knowledge-area-left-sidebar", require("./components/layouts/KnowledgeLeftSideBar").default);

/* Right Side Bar */
Vue.component("right-side-bar", require("./components/layouts/RightSideBar").default);

const app = new Vue({
    router,
    el: "#app",
    components: {
        frontApp,
        backApp
    },
    vuetify: new Vuetify(vuetifyOptions)
});

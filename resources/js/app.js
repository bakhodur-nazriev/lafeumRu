import Vue from "vue";

require("./bootstrap");

window.Vue = require("vue");

import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";
import {TiptapVuetifyPlugin} from "tiptap-vuetify";
import "tiptap-vuetify/dist/main.css";

const vuetify = new Vuetify({
    lang: {
        // If you change the language here, then it changes in the editor itself
        current: "en" // en | es | fr | pl | ru
    }
});

// Route information for Vue Router
import router from "./router.js";
import App from "./components/App";

// you don't need it. this is for example purposes
const iconsGroup = localStorage.getItem("current_icons_group") || "fa";
Vue.use(Vuetify);
Vue.use(TiptapVuetifyPlugin, {
    vuetify,
    iconsGroup: 'mdi'
});

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
                // accent: "#689F38",
                // success: "#4caf50",
                // warning: "#ffeb3b",
                // info: "#2196f3",
            }
        }
    }
};

// use this package's plugin
// Vue.use(TiptapVuetifyPlugin, {
//     iconsGroup: 'mdi'
// })

Vue.component("admin-dashboard", require("./components/pages/Home.vue").default);
Vue.component("Search", require("./components/layouts/Navbar.vue").default);
Vue.component("pagination", require("laravel-vue-pagination"));
// Vue.component("tiptap-vuetify", require("tiptap-vuetify"));

const app = new Vue({
    el: "#app",
    components: {App},
    router,
    vuetify: new Vuetify(vuetifyOptions),
});

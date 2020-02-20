import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";
import "tiptap-vuetify/dist/main.css";
import router from "./router.js";
import App from "./components/App";
import draggable from "vuedraggable";
// import plugin tip-tap vuetify
import { TiptapVuetifyPlugin } from "tiptap-vuetify";

require("./bootstrap");
window.Vue = require("vue");

const iconsGroup = localStorage.getItem("current_icons_group") || "fa";
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
                // accent: "#689F38",
                // success: "#4caf50",
                // warning: "#ffeb3b",
                // info: "#2196f3",
            }
        }
    }
};
const vuetify = new Vuetify({
    icons: {
        iconfont: "mdi"
    },
    lang: {
        current: "ru" // en | es | fr | pl | ru
    }
});

Vue.use("draggable");
Vue.use(Vuetify);
Vue.use(TiptapVuetifyPlugin, {
    vuetify,
    iconsGroup: "mdi"
});

/* BACKEND PARK */
Vue.component(
    "admin-dashboard",
    require("./components/admin/Home.vue").default
);
Vue.component("admin-favorite", require("./components/admin/Favorite.vue").default);
// Vue.component("pagination", require("laravel-vue-pagination"));

/* FRONTEND PART */
// Vue.component("default-footer", require("./components/layouts/Footer").default);
// Vue.component(
//     "frontend-authors",
//     require("./components/frontend/Authors").default
// );
// Vue.component("frontend-terms", require("./components/frontend/Terms").default);
// Vue.component(
//     "frontend-quotes",
//     require("./components/frontend/Quotes").default
// );

const app = new Vue({
    el: "#app",
    router,
    components: { App },
    vuetify: new Vuetify(vuetifyOptions)
});

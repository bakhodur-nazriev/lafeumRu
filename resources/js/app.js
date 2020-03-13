import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";
import "tiptap-vuetify/dist/main.css";
import router from "./router.js";
import App from "./components/App";
import draggable from "vuedraggable";
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

Vue.component(
    "admin-dashboard",
    require("./components/admin/Home.vue").default
);
/*Vue.component("admin-favorite", require("./components/admin/Favorite.vue").default);*/

const app = new Vue({
    el: "#app",
    router,
    components: { App },
    vuetify: new Vuetify(vuetifyOptions)
});

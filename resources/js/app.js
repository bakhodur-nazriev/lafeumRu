import Vue from "vue";

require("./bootstrap");

window.Vue = require("vue");

import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";

// Route information for Vue Router
import router from "./router.js";
import App from "./components/App";

Vue.use(Vuetify);

const vuetifyOptions = {
    icons: {
        iconfont: "mdi"
    },
    theme: {
        themes: {
            light: {
                primary: "#04718c",
                secondary: "#21353f"
                // accent: "#689F38",
                // success: "#4caf50",
                // error: "#EF5350",
                // warning: "#ffeb3b",
                // info: "#2196f3",
            }
        }
    }
};

Vue.component("admin-dashboard", require("./components/pages/Home.vue").default);
Vue.component("Search", require("./components/layouts/Navbar.vue").default);
Vue.component("pagination", require("laravel-vue-pagination"));

const app = new Vue({
    el: "#app",
    components: {App},
    router,
    vuetify: new Vuetify(vuetifyOptions),
});

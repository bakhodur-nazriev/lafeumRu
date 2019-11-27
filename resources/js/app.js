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
    }
};

Vue.component("admin-dashboard", require("./pages/Dashboard.vue").default);

Vue.component("admin-navbar", require("./components/Navbar.vue").default);
Vue.component("pagination", require("laravel-vue-pagination"));

const app = new Vue({
    el: "#app",
    components: {
        App
    },

    router,
    vuetify: new Vuetify(vuetifyOptions)
});

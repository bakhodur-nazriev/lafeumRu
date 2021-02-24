require("./constants");

import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";
import router from "./router.js";
import backApp from "./components/backApp";
import frontApp from "./components/frontApp";
import ru from 'vuetify/es5/locale/ru'

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
        locales: {ru},
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

Vue.component("default", require("./components/front/Default").default);
Vue.component("home", require("./components/front/Home").default);

const app = new Vue({
    router,
    el: "#app",
    components: {backApp, frontApp},
    vuetify: new Vuetify(vuetifyOptions)
});

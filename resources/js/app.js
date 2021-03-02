require("./constants");

import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";
import frontApp from "./components/frontApp";
import router from "./router.js";
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
Vue.component("front-navbar", require("./components/layouts/FrontNavbar").default);
Vue.component("front-footer", require("./components/layouts/FrontFooter").default);

/* Left Side Bar */
Vue.component("left-side-bar", require("./components/layouts/LeftSideBar").default);

/* Right Side Bar */
Vue.component("right-side-bar", require("./components/layouts/RightSideBar").default);

const app = new Vue({
    router,
    el: "#app",
    components: {frontApp},
    vuetify: new Vuetify(vuetifyOptions)
});

/*const app = new Vue({
    el: "#app",
    components: {app},
    vuetify: new Vuetify(vuetifyOptions)
});*/

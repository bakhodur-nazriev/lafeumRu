require("./constants");

import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";
import router from "./router.js";
import App from "./components/App";
import ru from 'vuetify/es5/locale/ru'

// //Import Froala Editor
// import 'froala-editor/js/plugins.pkgd.min.js';
//
// //Import third party plugins
// import 'froala-editor/js/third_party/embedly.min';
// import 'froala-editor/js/third_party/font_awesome.min';
// import 'froala-editor/js/third_party/spell_checker.min';
// import 'froala-editor/js/third_party/image_tui.min';
//
// // Import Froala Editor css files.
// import 'froala-editor/css/froala_editor.pkgd.min.css';
//
// // Import and use Vue Froala lib.
// import VueFroala from 'vue-froala-wysiwyg';
//
// Vue.use(VueFroala);

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
        locales: { ru },
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

const app = new Vue({
    el: "#app",
    router,
    components: {App},
    vuetify: new Vuetify(vuetifyOptions)
});

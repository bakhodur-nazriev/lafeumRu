require("./bootstrap");

window.Vue = require("vue");

import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";
Vue.use(
    Vuetify
);

const vuetifyOptions = {
    icons: {
        iconfont:
            "mdi"
    }
};

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue")
        .default
);
Vue.component(
    "my-component",
    require("./components/Mytest.vue")
        .default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue(
    {
        el:
            "#app",
        vuetify: new Vuetify(
            vuetifyOptions
        )
    }
);

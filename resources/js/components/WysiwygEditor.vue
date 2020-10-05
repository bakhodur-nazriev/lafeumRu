<template>
    <froala
        :label="label"
        :value="value"
        @input="textChanged"
    />
</template>

<script>

//Import Froala Editor
import 'froala-editor/js/plugins.pkgd.min.js';

//Import third party plugins
import 'froala-editor/js/third_party/embedly.min';
import 'froala-editor/js/third_party/font_awesome.min';
import 'froala-editor/js/third_party/spell_checker.min';
import 'froala-editor/js/third_party/image_tui.min';

// Import Froala Editor css files.
import 'froala-editor/css/froala_editor.pkgd.min.css';

// Import and use Vue Froala lib.
import VueFroala from 'vue-froala-wysiwyg';

export default {
    props: {
        value: String,
        label: String
    },
    beforeMount() {
        window.Vue.use(VueFroala);
    },
    methods: {
        textChanged(v) {
            this.$emit("input", v);
        }
    },
};
</script>

<style>
.second-toolbar > #logo {
    display: none;
}
</style>

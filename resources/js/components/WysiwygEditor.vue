<template>
    <froala
        :label="label"
        :value="value"
        :config="config"
        @input="textChanged"
    />
</template>

<script>

//Import Froala Editor
import 'froala-editor/js/plugins.pkgd.min.js';
import 'froala-editor/js/languages/ru.js';

//Import third party plugins
import 'froala-editor/js/third_party/embedly.min';
import 'froala-editor/js/third_party/font_awesome.min';
import 'froala-editor/js/third_party/spell_checker.min';
import 'froala-editor/js/third_party/image_tui.min';

// Import Froala Editor css files.
import 'froala-editor/css/froala_editor.pkgd.min.css';
import 'froala-editor/css/themes/gray.min.css';

// Import and use Vue Froala lib.
import VueFroala from 'vue-froala-wysiwyg';

export default {
    props: {
        value: String,
        label: String
    },
    data() {
        return {
            config: {
                theme: 'gray',
                zIndex: 2001,
                language: 'ru',
                placeholderText: this.label,
                toolbarButtons: {
                    moreText: {
                        buttons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting']
                    },
                    moreParagraph: {
                        buttons: ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
                    },
                    moreRich: {
                        buttons: ['insertLink', 'html']
                    },
                    moreMisc: {
                        align: 'right',
                        buttonsVisible: 2,
                        buttons: ['undo', 'redo', 'fullscreen']
                    }

                },
            }
        }
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

<template>
    <quill-editor
        :options="editorOptions"
        :value="value"
        @input="textChanged"
    />
</template>

<script>
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

import {quillEditor} from 'vue-quill-editor'

export default {
    props: {
        value: String,
        label: String
    },
    components: {quillEditor},
    methods: {
        textChanged(v) {
            this.$emit("input", v);
        }
    },
    computed: {
        editorOptions() {
            return {
                placeholder: this.label,
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike', 'blockquote'],        // toggled buttons
                        [{'header': 1}, {'header': 2}],               // custom button values
                        [{'list': 'ordered'}, {'list': 'bullet'}],
                        [{'indent': '-1'}, {'indent': '+1'}],          // outdent/indent

                        ['link', {
                            'color': [
                                'black',
                                '#B83336',
                                'white',
                                '#0099ff',
                                '#6c757d'
                            ]
                        }, {'background': []}],          // dropdown with defaults from theme
                        [{'align': []}],
                    ]
                }
            }
        }
    }
};
</script>

<style>
.ql-snow .ql-tooltip a.ql-action::after {
    margin-left: 0;
}

.ql-snow .ql-tooltip.ql-editing a.ql-action::after {
    content: 'Сохранить';
}

.ql-snow .ql-tooltip {
    position: sticky;
    width: 100%;
}

.ql-snow .ql-tooltip input[type=text] {
    width: 79%;
}
</style>

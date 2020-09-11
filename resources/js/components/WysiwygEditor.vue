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
 
import { quillEditor } from 'vue-quill-editor'

export default {
    props: {
        value: String,
        label: String
    },
    components: { quillEditor },
    methods: {
        textChanged(v) {
            this.$emit("input", v);
        }
    },
    computed: {
        editorOptions(){
            return {
                placeholder: this.label,
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike', 'blockquote'],        // toggled buttons

                        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent

                        ['link', { 
                            'color': [
                                'black',
                                '#B83336',
                                'white',
                                '#0099ff'
                            ] 
                        }, { 'background': [] }],          // dropdown with defaults from theme
                        [{ 'align': [] }],
                    ]
                }
            }
        }
    }
};
</script>
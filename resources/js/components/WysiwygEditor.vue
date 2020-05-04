<template>
    <tiptap-vuetify
        :extensions="extensions"
        :value="value"
        :placeholder="label"
        @input="textChanged"
        :card-props="{ flat: true, color: '#21252921' }"
    />
</template>

<script>
import {
    // component
    TiptapVuetify,
    // extensions
    Heading,
    Bold,
    Italic,
    Strike,
    Underline,
    Paragraph,
    BulletList,
    OrderedList,
    ListItem,
    Link,
    Blockquote,
    HardBreak,
    HorizontalRule,
    History,
    Code
} from "tiptap-vuetify";

export default {
    props: {
        value: String,
        label: String
    },
    components: { TiptapVuetify },
    data() {
        return {
            extensions: [
                History,
                Blockquote,
                Link,
                Underline,
                Strike,
                Italic,
                ListItem,
                BulletList,
                OrderedList,
                [
                    Heading,
                    {
                        options: {
                            levels: [1, 2, 3]
                        }
                    }
                ],
                Code,
                Bold,
                HorizontalRule,
                Paragraph,
                HardBreak
            ]
        };
    },
    methods: {
        textChanged(v) {
            this.$emit("input", v);
        }
    }
};
</script>

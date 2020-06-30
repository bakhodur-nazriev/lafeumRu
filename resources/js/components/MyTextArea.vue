<template>
    <!--<textarea
        @change=$emit"value"
    />-->
    <!--<textarea
        @change="textAreaChanged"
    />-->
</template>

<script>
    export default {
        props: {
            value: String
        },
        data() {
            return {
                lol: this.value
            }
        },
        /*methods: {
            textAreaChanged() {
                this.$emit("change-description", this.lol);
            }
        }*/
    }
</script>

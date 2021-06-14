<template>
    <v-col class="scrollBlock" v-if="scroll > 320">
        <v-btn class="my-1" small fab color="primary" v-scroll-to="'header'">
            <v-icon color="white">mdi-arrow-up</v-icon>
        </v-btn>
        <v-btn class="my-1" small fab color="primary" v-scroll-to="'footer'">
            <v-icon>mdi-arrow-down</v-icon>
        </v-btn>
    </v-col>
</template>

<script>
export default {
    name: "Scroller",
    data() {
        return {
            scroll: null
        }
    },
    methods: {
        handleScroll(e) {
            this.scroll = window.scrollY || window.scrollTop
        }
    },
    created() {
        window.addEventListener('scroll', this.handleScroll);
    },
    destroyed() {
        window.removeEventListener('scroll', this.handleScroll);
    }
}
</script>

<style scoped>
.scrollBlock {
    width: 4.3%;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    position: fixed;
    bottom: 20px;
    right: 110px;
    z-index: 10;
}
</style>

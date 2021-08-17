<template>
    <v-col class="scrollBlock">
        <v-btn
            fab
            small
            color="primary"
            class="my-1"
            v-show="fab"
            @click="toTop"
            v-scroll="onScrollToTop"
        >
            <v-icon color="white">mdi-arrow-up</v-icon>
        </v-btn>
        <v-btn
            fab
            small
            class="my-1"
            color="primary"
            v-show="fab"
            @click="toBottom"
            v-scroll="onScrollToBottom"
        >
            <v-icon>mdi-arrow-down</v-icon>
        </v-btn>
    </v-col>
</template>

<script>
export default {
    name: "Scroller",
    data() {
        return {
            scroll: null,
            fab: false
        }
    },
    methods: {
        onScrollToTop(e) {
            if (typeof window === 'undefined') return
            const top = window.pageYOffset || e.target.scrollTop || 0
            this.fab = top > 300
        },
        onScrollToBottom(e) {
            if (typeof window === 'undefined') return
            const bottom = window.pageYOffset || e.target.scrollHeight || 0
            this.fab = bottom > 300
        },
        toTop() {
            this.$vuetify.goTo(0);
        },
        toBottom() {
            this.$vuetify.goTo('footer');
        }
    },

}
</script>

<style scoped>
@media (max-width: 600px) {
    .scrollBlock {
        bottom: 10px;
        right: 10px;
    }
}

@media (min-width: 600px) and (max-width: 960px) {
    .scrollBlock {
        bottom: 10px;
        right: 10px;
    }
}

@media (min-width: 960px) and (max-width: 1264px) {
    .scrollBlock {
        bottom: 10px;
        right: 10px;
    }
}

@media (min-width: 1264px) {
    .scrollBlock {
        right: 140px;
    }
}

.scrollBlock {
    width: 65px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    position: fixed;
    bottom: 20px;
    z-index: 10;
}

</style>

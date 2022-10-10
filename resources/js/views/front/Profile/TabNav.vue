<template>
    <div>
        <div class="d-flex primary rounded-lg mb-3 pa-1">
            <div v-for="tab in tabs" :key="tab" class="d-flex">
                <a
                    class="nav-link text-white"
                    :class="{ active: tab === selected, 'green' : hasError }"
                    @click="setTab(tab)"
                >
                    {{ tab }}
                </a>
            </div>
        </div>

        <slot></slot>
    </div>
</template>

<script>
export default {
    name: "TabNav",
    props: {
        tabs: {
            type: Array,
            required: true
        },
        selected: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            hasError: true
        }
    },
    methods: {
        setTab(tab) {
            this.$emit('selected', tab);
        }
    }
}
</script>

<style scoped>

</style>

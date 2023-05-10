<template>
    <div class="pa-3 main-block">
        <v-card tile width="800" elevation="0" class="mx-auto rounded-lg pa-3"></v-card>
    </div>
</template>

<script>
export default {
    name: "Settings"
}
</script>

<style scoped>
@media (max-width: 767px) {
    .main-block {
        max-width: 100%;
    }
}

@media (min-width: 768px) {
    .main-block {
        max-width: 100%;
    }
}
</style>

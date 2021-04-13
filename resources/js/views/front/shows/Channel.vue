<template>
    <v-col xl="5">
        <h5 class="text-uppercase font-weight-regular py-4">Каналы</h5>
        <div>
            <h3 class="blue--text">{{ channel.name }}</h3>
            <h5 class="font-weight-normal">{{channel.description}}</h5>
        </div>
    </v-col>
</template>

<script>
export default {
    props: ["channel"],
    name: "Channel",
    data() {
        return {}
    }
}
</script>

<style scoped>

</style>

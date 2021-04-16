<template>
    <v-col xl="5">
        <h5 class="text-uppercase font-weight-regular py-4">Каналы</h5>
        <div class="mb-5">
            <h3 class="blue--text">{{ channel.name }}</h3>
            <h5 class="channel-description">{{ channel.description }}</h5>
        </div>

        <video-item
            v-for="(video, i) in channel.videos.data"
            :key="i"
            :video="video"
        ></video-item>
    </v-col>
</template>

<script>
export default {
    name: "Channel",
    props: ["channel"],
    data() {
        return {}
    }
}
</script>

<style scoped>
.channel-description {
    font-weight: 400;
    font-size: 16px;
    line-height: 22px;
}
</style>

<template>
    <v-dialog v-if="channelToDelete" v-model="channelToDelete" width="500">
        <v-card class="pa-2">
            <v-card-title class="pt-1 regular headline text-center">
                Вы действительно хотите удалить этот канал ?
            </v-card-title>
            <v-card-actions class="justify-center">
                <v-btn
                    color="green darken-1"
                    dark
                    @click="$emit('input', null)"
                >
                    Нет
                </v-btn>
                <v-btn color="red darken-1" dark @click="deleteChannel()"
                    >Да</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        value: Object
    },
    methods: {
        deleteChannel() {
            axios
                .delete("/api/channels/" + this.channelToDelete.slug)
                .then(res => {
                    this.$emit('deleted');
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        channelToDelete: {
            get() {
                return this.value;
            },
            set(v) {
                if (!v) {
                    this.$emit("input", null);
                }
            }
        }
    }
};
</script>

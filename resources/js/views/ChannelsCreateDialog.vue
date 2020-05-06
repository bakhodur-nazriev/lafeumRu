<template>
    <v-dialog v-model="value" width="700px">
        <v-card>
            <v-card-title class="primary white--text">
                Создать Канал
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field
                            label="Добавить назавние канала"
                            v-model="newChannel.name"
                            hide-details
                            outlined
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            label="Добавить описание к каналу"
                            v-model="newChannel.description"
                            outlined
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer />
                <v-btn dark color="green" @click="addChannel()"
                    >Сохранить</v-btn
                >
                <v-btn dark color="error" @click="$emit('input', false)"
                    >Отмена</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        value: Boolean
    },
    data() {
        return {
            newChannel: null
        };
    },
    beforeMount(){
        this.newChannel = this.getDefaultChannel();
    },
    methods: {
        getDefaultChannel(){
            return {
                name: '',
                description: ''
            };
        },
        addChannel() {
            axios
                .post("/api/channels/", this.newChannel)
                .then(res => {
                    this.newChannel = this.getDefaultChannel();
                    this.$emit('created', res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

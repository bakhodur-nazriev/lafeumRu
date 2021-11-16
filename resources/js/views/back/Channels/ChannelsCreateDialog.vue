<template>
    <v-dialog :value="value" @input="$emit('input', false)" width="700px">
        <v-card>
            <v-card-title class="primary white--text">
                Создать Канал
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12" class="py-0">
                        <v-text-field
                            dense
                            outlined
                            v-model="newChannel.name"
                            label="Добавить назавние канала"
                        />
                    </v-col>
                    <v-col cols="12" class="py-0">
                        <wysiwyg-editor
                            v-model="newChannel.description"
                            label="Добавить описание к каналу"
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer/>
                <v-btn dark color="primary" @click="addChannel()">Сохранить</v-btn>
                <v-btn dark color="primary" @click="$emit('input', false)">Отмена</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import WysiwygEditor from '../../../components/WysiwygEditor';

export default {
    props: {
        value: Boolean
    },
    components: {WysiwygEditor},
    data() {
        return {
            newChannel: null
        };
    },
    beforeMount() {
        this.newChannel = this.getDefaultChannel();
    },
    methods: {
        getDefaultChannel() {
            return {
                name: "",
                description: ""
            };
        },
        addChannel() {
            axios
                .post("/api/channels", this.newChannel)
                .then(res => {
                    this.newChannel = this.getDefaultChannel();
                    this.$emit("created", res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

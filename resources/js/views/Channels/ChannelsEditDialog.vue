<template>
    <v-dialog v-if="channelToUpdate" v-model="channelToUpdate" width="700px">
        <v-card>
            <v-card-title class="primary white--text">
                Изменить Канал
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field
                            v-model="channelToUpdate.name"
                            label="Изменить имя канала"
                            hide-details
                            outlined
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <wysiwyg-editor
                            v-model="channelToUpdate.description"
                            label="Изменить описание канала"
                        />
                    </v-col>
                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer />
                <v-btn dark color="green" @click="updateChannel()"
                    >Сохранить</v-btn
                >
                <v-btn dark color="error" @click="$emit('input', null)"
                    >Отмена</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import WysiwygEditor from '../../components/WysiwygEditor';

export default {
    props: {
        value: Object
    },
    components: { WysiwygEditor },
    methods: {
        updateChannel() {
            axios
                .put("/api/channels/" + this.channelToUpdate.slug, {
                    name: this.channelToUpdate.name,
                    description: this.channelToUpdate.description
                })
                .then(res => {
                    this.$emit('updated', res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        channelToUpdate: {
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

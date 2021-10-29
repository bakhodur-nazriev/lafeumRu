<template>
<!--    <v-dialog v-model="showDialog" width="700">
        <v-card v-if="showDialog">
            <v-card-title class="primary white&#45;&#45;text pa-4">
                Фото
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12">
                        <v-text-field
                            outlined
                            readonly
                            hide-details
                            label="Дата добавления"
                            v-model="feedback.user_name"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            outlined
                            readonly
                            hide-details
                            label="Дата добавления"
                            v-model="feedback.user_email"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            outlined
                            readonly
                            hide-details
                            label="Дата добавления"
                            v-model="feedback.topic"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            outlined
                            readonly
                            hide-details
                            label="Дата добавления"
                            v-model="feedback.created_at"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            outlined
                            readonly
                            rows="2"
                            hide-details
                            label="Описания"
                            v-model="feedback.message"
                        />
                    </v-col>

                </v-row>
            </v-container>
            <v-card-actions>
                <v-spacer/>
                <v-btn
                    dark
                    color="primary"
                    @click="closeDialog"
                >
                    Закрыть
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>-->
</template>

<script>
export default {
    props: {
        feedback: Object
    },
    methods: {
        closeDialog() {
            this.$emit('close');
        }
    },
    computed: {
        showDialog: {
            get() {
                return this.photo
            },
            set(show) {
                if (!show) {
                    this.closeDialog();
                }
            }
        }
    }
}
</script>

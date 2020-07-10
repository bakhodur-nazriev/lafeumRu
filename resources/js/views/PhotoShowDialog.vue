<template>
    <!-- Show Item Dialog -->
    <v-dialog v-model="showDialog" width="700">
        <v-card v-if="showDialog">
            <v-card-title class="primary white--text pa-4">
                Фото
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col col="12">
                        <v-img
                            class="rounded"
                            :src="photo.path"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            v-model="photo.description"
                            outlined
                            readonly
                            label="Описания"
                            hide-details
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            v-model="photo.created_at"
                            outlined
                            readonly
                            label="Дата добавления"
                            hide-details
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            v-model="photo.updated_at"
                            outlined
                            readonly
                            label="Дата изменения"
                            hide-details
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
    </v-dialog>
</template>

<script>
    export default {
        props: {
            photo: Object
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

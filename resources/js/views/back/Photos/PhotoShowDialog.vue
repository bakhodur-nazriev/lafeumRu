<template>
    <!-- Show Item Dialog -->
    <v-dialog v-model="showDialog" width="800">
        <v-card v-if="showDialog">
            <v-card-title class="primary white--text pa-4">
                Фото
            </v-card-title>
            <v-container>
                <v-row justify="center">
                    <v-col col="12" class="pt-0">
                        <v-img
                            height="100%"
                            class="rounded"
                            :src="photo.path"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            dense
                            outlined
                            readonly
                            hide-details
                            label="Заголовок"
                            v-model="photo.title"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            dense
                            outlined
                            readonly
                            hide-details
                            label="Дата изменения"
                            v-model="photo.updated_at"
                        />
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            outlined
                            readonly
                            hide-details
                            rows="4"
                            label="Описания"
                            v-model="photo.description"
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

<template>
    <v-container fluid>
        <v-row justify="center mb-4">
            <v-col md="6" xl="4">
                <v-text-field
                    solo
                    hide-details
                    label="Поиск"
                    append-icon="mdi-magnify"
                    v-model="search"
                >
                </v-text-field>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-card class="col-lg-12 col-xl-8 p-0">
                <v-tabs
                    v-model="tabs"
                    fixed-tabs
                    background-color="primary"
                    dark
                    flat
                >
                    <v-tabs-slider></v-tabs-slider>
                    <v-tab href="#mobile-tabs-1" class="text-decoration-none">
                        Цитаты
                    </v-tab>
                    <v-tab href="#mobile-tabs-2" class="text-decoration-none">
                        Термины
                    </v-tab>
                    <v-tab href="#mobile-tabs-3" class="text-decoration-none">
                        Видео
                    </v-tab>
                </v-tabs>

                <v-tabs-items v-model="tabs">
                    <v-tab-item value="mobile-tabs-1">
                        <v-card>
                            <v-col><a href="#"></a></v-col>
                            <v-col class="pa-2">
                                <p class="mb-2"></p>
                                <span>
                                    <v-icon small color="primary">mdi-tag</v-icon>
                                    <span></span>
                                </span>
                                <v-divider class="my-2"></v-divider>
                                <v-btn depressed small color="primary">Поделиться</v-btn>
                            </v-col>
                        </v-card>
                    </v-tab-item>

                    <v-tab-item value="mobile-tabs-2">
                        <v-card>
                            <div class="pa-2"/>
                            <v-col class="pa-2">
                                <span>
                                    <v-icon small color="primary">mdi-tag</v-icon>
                                    <span></span>
                                </span>
                                <v-divider class="my-2"></v-divider>
                                <v-btn depressed small color="primary">Поделиться</v-btn>
                            </v-col>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item value="mobile-tabs-3">
                        <v-col>
                            <v-row>
                                <v-col>
                                    <v-card class="pa-4 d-flex flex-column h-100">
                                        <div class="mb-2">
                                            <a class="mb-2"></a>
                                            <div></div>
                                            <h5></h5>
                                        </div>
                                        <v-spacer></v-spacer>
                                        <div>
                                            <span>
                                                <v-icon small color="primary">mdi-tag</v-icon>
                                                <span></span>
                                            </span>
                                            <v-divider class="my-2"></v-divider>
                                            <v-btn depressed small color="primary">Поделиться</v-btn>
                                        </div>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-tab-item>
                </v-tabs-items>
            </v-card>
        </v-row>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {}
        }
    }
</script>

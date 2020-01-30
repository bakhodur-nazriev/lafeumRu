<template>
    <v-content class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-col cols="6">
                    <v-text-field
                        class="mb-1"
                        hide-details
                        solo
                        label="Поиск"
                        append-icon="mdi-magnify"
                        v-model="search"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-data-table
                        :headers="headers"
                        :items="filteredChannels"
                        :items-per-page="itemsPerPage"
                        :page.sync="page"
                        @page-count="pageCount = $event"
                        hide-default-footer
                        class="elevation-1"
                    >
                        <template v-slot:item.action="{ item }">
                            <v-btn
                                fab
                                dark
                                small
                                color="primary"
                                elevation="2"
                                outlined
                                @click="channelToUpdate = {...item}"
                            >
                                <v-icon dark>mdi-pen</v-icon>
                            </v-btn>
                            <v-btn
                                fab
                                dark
                                small
                                color="primary"
                                elevation="2"
                                outlined
                                @click="channelToShow = item"
                            >
                                <v-icon dark>mdi-file-eye-outline</v-icon>
                            </v-btn>
                            <v-btn
                                fab
                                dark
                                small
                                color="error"
                                elevation="2"
                                outlined
                                @click="channelToDelete = item"
                            >
                                <v-icon dark>mdi-delete</v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.description="{ item }">
                            <div v-html="item.description" class="short-paragraph"></div>
                        </template>
                    </v-data-table>
                </v-col>
                <div class="text-center pt-2">
                    <v-pagination v-model="page" :length="pageCount"></v-pagination>
                </div>
            </v-row>
        </v-container>
        <v-tooltip top>
            <template v-slot:activator="{ on }">
                <v-btn
                    bottom
                    color="primary"
                    v-on="on"
                    dark
                    fab
                    fixed
                    right
                    @click="dialogAdd = !dialogAdd"
                >
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>
            <span>Добавить видео</span>
        </v-tooltip>

        <!-- Add Item Dialog -->
        <v-dialog v-model="dialogAdd" width="700px">
            <v-card>
                <v-card-title class="primary white--text">
                    Создать Канал
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-text-field
                                label="Добаить назавния видео"
                                v-model="channelName"
                                hide-details
                                outlined
                            >
                            </v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <tiptap-vuetify
                                placeholder="Добавить описание к каналу"
                                v-model="channelDescription"
                                :extensions="extensions"
                                outlined
                            >
                            </tiptap-vuetify>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="addChannel()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="() => (dialogAdd = false)">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Delete Item Dialog -->
        <v-dialog v-if="channelToDelete" v-model="channelToDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center">
                    Вы действительно хотите удалить этот канал ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn color="green darken-1" dark @click="channelToDelete = null">
                        Нет
                    </v-btn>
                    <v-btn color="red darken-1" dark @click="deleteChannel()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Update Item Dialog -->
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
                            <tiptap-vuetify
                                v-model="channelToUpdate.description"
                                placeholder="Изменить описание канала"
                                :extensions="extensions"
                                outlined
                            >
                            </tiptap-vuetify>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="updateChannel()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="channelToUpdate = false">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Show Quote Dialog -->
        <v-dialog v-if="channelToShow" v-model="channelToShow"></v-dialog>
    </v-content>
</template>

<script>
    import {
        // component
        TiptapVuetify,
        // extensions
        Heading,
        Bold,
        Italic,
        Strike,
        Underline,
        Code,
        Paragraph,
        BulletList,
        OrderedList,
        ListItem,
        Link,
        Blockquote,
        HardBreak,
        HorizontalRule,
        History,
        Image
    } from 'tiptap-vuetify';
    export default {
        components: {TiptapVuetify},
        data() {
            return {
                dialogAdd: false,
                dialogDelete: false,
                dialogUpdate: false,
                dialogShow: false,
                channelName: "",
                channelDescription: "",
                channelToDelete: null,
                channelToUpdate: null,
                channelToShow: null,
                channels: [],
                search: "",
                page: 1,
                pageCount: 2,
                itemsPerPage: 12,
                extensions: [
                    History,
                    Blockquote,
                    Link,
                    Underline,
                    Strike,
                    Italic,
                    ListItem,
                    BulletList,
                    OrderedList,
                    Image,
                    [
                        Heading,
                        {
                            options: {
                                levels: [1, 2, 3]
                            }
                        }
                    ],
                    Bold,
                    HorizontalRule,
                    Paragraph,
                    HardBreak
                ],
                headers: [
                    {
                        text: 'Названия',
                        value: 'name',
                        sortable: false,
                    },
                    {
                        text: 'Описания',
                        value: 'description',
                        sortable: false,
                    },
                    {
                        text: "Действия",
                        value: "action",
                        align: "center",
                        sortable: false,
                        width: "160px"
                    }
                ],
            }
        },
        mounted() {
            this.loadChannels();
        },
        methods: {
            loadChannels() {
                axios
                    .get('/api/channels')
                    .then(res => {
                        this.channels = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            addChannel() {
                axios
                    .post('/api/channels/', {
                        name: this.channelName,
                        description: this.channelDescription
                    })
                    .then(res => {
                        this.loadChannels();
                        this.dialogAdd = false;
                    })
                    .catch((err) => {
                        console.log(err)
                    });
            },
            updateChannel() {
                axios
                    .put('/api/channels/' + this.channelToUpdate.id, {
                        name: this.channelToUpdate.name,
                        description: this.channelToUpdate.description
                    })
                    .then(res => {
                        this.channelToUpdate = false;
                        this.loadChannels();
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            deleteChannel() {
                axios
                    .delete('/api/channels/' + this.channelToDelete.id)
                    .then(res => {
                        this.channelToDelete = false;
                        this.loadChannels();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        computed: {
            filteredChannels() {
                return this.channels.filter(channel => {
                    return channel.name.toLowerCase().includes(this.search.toLowerCase());
                })
            }
        }
    }
</script>

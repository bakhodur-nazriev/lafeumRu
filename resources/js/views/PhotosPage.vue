<template>
    <v-content class="pa-0">
        <index-page-layout
            index-url="/api/photos"
            :table-headers="this.headers"
            add-label="Добавить фото"
            searchField="description"
            ref="indexPage"
            @click:item="photoClick"
            @add-item="dialogAdd = true"
            @update-item="photoToUpdate = $event"
            @delete-item="photoToDelete = $event"
        >
            <template v-slot:item.image="{ item }">
                <div class="text-center pa-2">
                    <v-img
                        :src="item.path"
                        :alt="item.description"
                        max-width="6rem"
                    >
                    </v-img>
                </div>
            </template>
        </index-page-layout>

        <!-- Add Item Dialog -->
        <v-dialog v-model="dialogAdd" width="700">
            <v-card>
                <v-card-title class="primary white--text pa-4">
                    Добавить фото
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-file-input
                                prepend-inner-icon="mdi-camera"
                                label="Выберите фото"
                                prepend-icon=""
                                hide-details
                                outlined
                                v-model="photoImage"
                            ></v-file-input>
                        </v-col>
                        <v-col cols="12">
                            <v-dialog
                                ref="dialog"
                                v-model="modalDate"
                                persistent
                                width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                        v-model="photoCreatedAtDate"
                                        label="Выберите дату"
                                        prepend-inner-icon="mdi-calendar"
                                        readonly
                                        outlined
                                        v-on="on"
                                        hide-details
                                    ></v-text-field>
                                </template>
                                <v-date-picker v-model="photoCreatedAtDate" scrollable>
                                    <v-spacer></v-spacer>
                                    <v-btn text color="primary" @click="modalDate= false">Отмена</v-btn>
                                    <v-btn text color="primary"
                                           @click="$refs.dialog.save(photoCreatedAtDate.created_at)">OK
                                    </v-btn>
                                </v-date-picker>
                            </v-dialog>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                outlined
                                v-model="photoDescription"
                                label="Добавить описание"
                                hide-details
                            />
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="addPhoto()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="() => (dialogAdd = false)">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Delete Item Dialog -->
        <v-dialog v-if="photoToDelete" v-model="photoToDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center pa-4">
                    Вы действительно хотите удалить это фото ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn color="green darken-1" dark @click="termToDelete = false">Нет</v-btn>
                    <v-btn color="red darken-1" dark @click="deletePhoto()">Да
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Update Item Dialog -->
        <v-dialog v-if="photoToUpdate" v-model="photoToUpdate" width="700">
            <v-card>
                <v-card-title class="primary white--text pa-4">
                    Изменить описание фото
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-dialog
                                ref="dialog"
                                v-model="modalDate"
                                :return-value.sync="photoToUpdate.updated_at"
                                persistent
                                width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                        v-model="photoToUpdate.updated_at"
                                        label="Выберите дату"
                                        prepend-inner-icon="mdi-calendar"
                                        readonly
                                        outlined
                                        v-on="on"
                                        hide-details
                                    ></v-text-field>
                                </template>
                                <v-date-picker v-model="photoToUpdate.updated_at" scrollable>
                                    <v-spacer></v-spacer>
                                    <v-btn text color="primary" @click="modalDate= false">Отмена</v-btn>
                                    <v-btn text color="primary" @click="$refs.dialog.save(photoToUpdate.updated_at)">
                                        OK
                                    </v-btn>
                                </v-date-picker>
                            </v-dialog>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                outlined
                                v-model="photoToUpdate.description"
                                label="Изменить описание фото"
                                hide-details
                            />
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="updatePhoto()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="photoToUpdate = false">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Show Item Dialog -->
        <v-dialog :value="photoToShow" @input="" width="700">
        <!--<v-dialog v-model="photoToShow" width="700">-->
            <v-card v-if="photoToShow">
                <v-card-title class="primary white--text pa-4">
                    Фото
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col col="12">
                            <v-img
                                src=""
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                v-model="photoToShow.description"
                                outlined
                                readonly
                                label="Описания"
                                hide-details
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                v-model="photoToShow.created_at"
                                outlined
                                readonly
                                label="Дата добавления"
                                hide-details
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
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
                    <v-btn dark color="primary" @click="photoToShow = false">
                        Закрыть
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

    </v-content>
</template>
<script>
    import IndexPageLayout from "../components/IndexPageLayout";

    export default {
        components: {IndexPageLayout},
        data() {
            return {
                modalDate: false,
                dialogAdd: false,
                photoImage: [],
                photoDescription: "",
                photoCreatedAtDate: null,
                photoToShow: null,
                photoToDelete: null,
                photoToUpdate: null,
                headers: [
                    {
                        text: "Фото",
                        value: "image",
                        sortable: false,
                        class: "mine-table-headers",
                        width: "150px",
                        align: "center"
                    },
                    {
                        text: "Описание",
                        value: "description",
                        sortable: false
                    },
                    {
                        text: "Дата добавления",
                        value: "created_at",
                        align: "center",
                        sortable: false
                    },
                    {
                        text: "Дата изменения",
                        value: "updated_at",
                        align: "center",
                        sortable: false
                    }
                ]
            };
        },
        methods: {
            addPhoto() {
                const formData = new FormData();
                formData.append("path", this.photoImage);
                formData.append("description", this.photoDescription);
                formData.append("created_at", this.photoCreatedAtDate);
                axios
                    .post("/api/photos/", formData, {
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(res => {
                        this.dialogAdd = false;
                        this.$refs.indexPage.loadItems();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            updatePhoto() {
                axios
                    .put("/api/photos/" + this.photoToUpdate.id, {
                        description: this.photoToUpdate.description,
                        updated_at: this.photoToUpdate.updated_at
                    })
                    .then(res => {
                        this.photoToUpdate = false;
                        this.$refs.indexPage.loadItems();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            deletePhoto() {
                axios
                    .delete("/api/photos/" + this.photoToDelete.id)
                    .then(res => {
                        this.$refs.indexPage.loadItems();
                        this.photoToDelete = false;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            photoClick(photo) {
                this.photoToShow = photo;
            },
        },
        watch: {
            photoToShow(v){
                console.log(v);
            }
        }
    };
</script>

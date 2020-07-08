<template>
    <v-content class="pa-0">
        <index-page-layout
            index-url="/api/photos"
            :table-headers="this.headers"
            add-label="Добавить фото"
            searchField="description"
            ref="indexPage"
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
        <v-dialog v-model="dialogAdd" width="700px">
            <v-card>
                <v-card-title class="primary white--text">
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
                            <v-textarea
                                outlined
                                v-model="photoDescription"
                                label="Добавить описание здесь"
                            />
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer />
                    <v-btn dark color="green" @click="addPhoto()"
                        >Сохранить</v-btn
                    >
                    <v-btn dark color="error" @click="() => (dialogAdd = false)"
                        >Отмена</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Delete Item Dialog -->
        <v-dialog v-if="photoToDelete" v-model="photoToDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center"
                    >Вы действительно хотите удалить это термин ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn
                        color="green darken-1"
                        dark
                        @click="termToDelete = false"
                        >Нет</v-btn
                    >
                    <v-btn color="red darken-1" dark @click="deletePhoto()"
                        >Да</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Update Item Dialog -->
        <v-dialog v-if="photoToUpdate" v-model="photoToUpdate" width="700px">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить описание фото
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-textarea
                                outlined
                                v-model="photoToUpdate.description"
                                label="Изменить описание фото здесь"
                            />
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer />
                    <v-btn dark color="green" @click="updatePhoto()"
                        >Сохранить</v-btn
                    >
                    <v-btn dark color="error" @click="photoToUpdate = false"
                        >Отмена</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-content>
</template>
<script>
import IndexPageLayout from "../components/IndexPageLayout";

export default {
    components: {
        IndexPageLayout
    },
    data() {
        return {
            dialogAdd: false,
            photoImage: [],
            photoDescription: "",
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
                }
            ]
        };
    },
    methods: {
        addPhoto() {
            const formData = new FormData();
            formData.append("image", this.photoImage);
            formData.append("description", this.photoDescription);
            axios
                .post("/api/photos", formData, {
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
                    description: this.photoToUpdate.description
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
        }
    }
};
</script>

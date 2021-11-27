<template>
    <v-main class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-col md="5">
                    <v-text-field
                        solo
                        class="mb-3"
                        hide-details
                        label="Поиск"
                        v-model="search"
                        append-icon="mdi-magnify"
                    />
                </v-col>
            </v-row>
            <v-data-table
                :headers="headers"
                class="elevation-1"
                hide-default-footer
                :items="filteredUsers"
                :loading="usersLoading"
            >
                <template v-slot:item.avatar="{ item }">
                    <v-avatar class="my-1">
                        <img :src="item.avatar"/>
                    </v-avatar>
                </template>
                <template v-slot:item.action="{ item }">
                    <v-btn
                        fab
                        dark
                        small
                        color="primary"
                        elevation="2"
                        @click="userToUpdate = { ...item }"
                    >
                        <v-icon dark>mdi-pen</v-icon>
                    </v-btn>
                    <v-btn
                        fab
                        dark
                        small
                        color="error"
                        elevation="2"
                        @click="userToDelete = { ...item }"
                    >
                        <v-icon dark>mdi-delete</v-icon>
                    </v-btn>
                </template>
            </v-data-table>
        </v-container>
        <v-dialog v-model="showUpdateDialog" width="600">
            <v-card v-if="showUpdateDialog">
                <v-card-title class="primary white--text mb-5">
                    Изменение пользователя
                </v-card-title>
                <v-card-text class="pb-0 px-4">
                    <v-text-field
                        dense
                        outlined
                        label="Имя пользователя"
                        v-model="userToUpdate.name"
                    />
                    <v-text-field
                        dense
                        outlined
                        label="Email пользователя"
                        v-model="userToUpdate.email"
                    />
                    <v-select
                        dense
                        outlined
                        item-value="id"
                        item-text="name"
                        :items="roles"
                        label="Роль пользователя"
                        v-model="userToUpdate.role_id"
                    />
                </v-card-text>
                <v-card-actions class="pa-4 pt-0">
                    <v-spacer/>
                    <v-btn color="primary" @click="updateUser()">Сохранить</v-btn>
                    <v-btn color="primary" @click="userToUpdate = null">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="showDeleteDialog" width="430">
            <v-card v-if="showDeleteDialog" class="pa-2">
                <v-card-title class="font-weight-medium regular headline text-center pa-2">
                    Вы действительно хотите удалить пользователя
                    {{ userToDelete.name }} ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn color="primary" @click="userToDelete = null">
                        Нет
                    </v-btn>
                    <v-btn color="primary" @click="deleteUser()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-main>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            usersLoading: false,
            headers: [
                {text: "Аватар", value: "avatar"},
                {text: "Имя", value: "name"},
                {text: "Email", value: "email"},
                {text: "Роль", value: "role.name"},
                {
                    text: "Действия",
                    value: "action",
                    align: "center",
                    sortable: false,
                    width: "160px"
                }
            ],
            roles: [],
            search: "",
            userToUpdate: null,
            userToDelete: null
        };
    },
    mounted() {
        this.loadUsers();
        this.loadRoles();
    },
    methods: {
        loadUsers() {
            this.usersLoading = true;
            axios
                .get("/api/users")
                .then(res => {
                    this.users = res.data;
                    this.usersLoading = false;
                })
                .catch(err => console.log(err));
        },
        loadRoles() {
            axios
                .get("/api/roles")
                .then(res => (this.roles = res.data))
                .catch(err => console.log(err));
        },
        updateUser() {
            axios
                .put("/api/users/" + this.userToUpdate.id, this.userToUpdate)
                .then(res => {
                    this.loadUsers();
                    this.userToUpdate = false;
                })
                .catch(err => console.log(err));
        },
        deleteUser() {
            axios
                .delete("/api/users/" + this.userToDelete.id)
                .then(res => {
                    this.userToDelete = false;
                    this.loadUsers();
                })
                .catch(err => console.log(err));
        }
    },
    computed: {
        filteredUsers() {
            return this.users.filter(user => {
                return user.name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
        showUpdateDialog: {
            get() {
                return this.userToUpdate;
            },
            set(v) {
                if (!v) {
                    this.userToUpdate = null;
                }
            }
        },
        showDeleteDialog: {
            get() {
                return this.userToDelete;
            },
            set(v) {
                if (!v) {
                    this.userToDelete = null;
                }
            }
        }
    }
};
</script>

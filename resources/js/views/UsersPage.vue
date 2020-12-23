<template>
    <v-main class="pa-0">
        <v-container>
            <v-row justify="center">
                <v-col md="6">
                    <v-text-field
                        solo
                        class="mb-3"
                        hide-details
                        label="Поиск"
                        append-icon="mdi-magnify"
                        v-model="search"
                    >
                    </v-text-field>
                </v-col>
            </v-row>
            <v-data-table
                :headers="headers"
                :items="filteredUsers"
                hide-default-footer
                class="elevation-1"
                :loading="usersLoading"
            >
                <template v-slot:item.avatar="{ item }">
                    <v-avatar class="my-1">
                        <img :src="item.avatar" />
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
                        v-model="userToUpdate.name"
                        label="Имя пользователя"
                        outlined
                    />
                    <v-text-field
                        v-model="userToUpdate.email"
                        label="Email пользователя"
                        outlined
                    />
                    <v-select
                        v-model="userToUpdate.role_id"
                        :items="roles"
                        item-text="name"
                        item-value="id"
                        label="Роль пользователя"
                        outlined
                    />
                </v-card-text>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="updateUser()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="userToUpdate = null">Отмена</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="showDeleteDialog" width="430">
            <v-card v-if="showDeleteDialog" class="pa-2">
                <v-card-title class="font-weight-regular regular headline text-center pa-2">
                    Вы действительно хотите удалить пользователя
                    {{ userToDelete.name }} ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn
                        dark
                        color="green darken-1"
                        @click="userToDelete = null"
                    >
                        Нет
                    </v-btn>
                    <v-btn color="red darken-1" dark @click="deleteUser()">Да</v-btn>
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
                .catch(e => console.log(e));
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

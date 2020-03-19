<template>
    <v-content class="pa-0">
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
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                    <tr>
                        <th class="text-left">Имя</th>
                        <th class="text-left">Email</th>
                        <!--<th class="text-left">Password</th>-->
                        <th class="text-right">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users" :key="user.name">
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <!--<td>{{ user.password }}</td>-->
                        <td class="text-right">
                            <v-btn depressed small color="primary">Изменить</v-btn>
                            <v-btn depressed small color="error" @click="userToDelete = user">Удалить</v-btn>
                        </td>
                    </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-container>
        <v-dialog v-if="userToDelete" v-model="userToDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center">
                    Вы действительно хотите удалить этого пользователя ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn color="green darken-1" dark @click="userToDelete = null">
                        Нет
                    </v-btn>
                    <v-btn color="red darken-1" dark @click="deleteChannel()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-content>
</template>


<script>
    export default {
        data() {
            return {
                users: [],
                search: "",
                userToDelete: null
            }
        },
        mounted() {
            this.loadUsers();
        },
        methods: {
            loadUsers() {
                axios
                    .get("/api/users")
                    .then(res => {
                        this.users = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            deleteUser() {
                axios
                    .delete("/admin/users" + this.userToDelete.id)
                    .then(res => {
                        this.userToDelete = false;
                        this.loadUsers;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        },
        computed: {
            filteredUsers() {
                return this.users.filter(user => {
                    return user.name.toLowerCase().includes(this.search.toLowerCase());
                })
            }
        }
    }
</script>

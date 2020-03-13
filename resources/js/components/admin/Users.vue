<template>
    <v-simple-table height="300px">
        <template v-slot:default>
            <thead>
            <tr>
                <th class="text-left">Имя</th>
                <th class="text-left">Email</th>
                <th class="text-left">Password</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users" :key="user.name">
                <td>{{ user.name }}</td>
                <!--                <td>{{ user.email }}</td>-->
                <!--                <td>{{ user.password }}</td>-->
            </tr>
            </tbody>
        </template>
    </v-simple-table>
</template>


<script>
    export default {
        data() {
            return {
                users: []
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
            }
        }
    }
</script>

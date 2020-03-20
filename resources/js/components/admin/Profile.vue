<template>
    <v-container>
        <v-card>
            <v-card-title class="justify-space-between align-items-start">
                <span class="headline font-weight-bold">Мой профиль</span>
                <v-avatar size="120" tile>
                    <img :src="this.user.avatar">
                </v-avatar>
            </v-card-title>
            <v-card-text class="py-0">
                <label class="subtitle-1 font-weight-bold ml-3 mb-1">Имя профилья</label>
                <v-text-field
                    disabled class="mb-4"
                    hide-details
                    :label="this.user.name"
                ></v-text-field>
                <label class="subtitle-1 ml-3 mb-1">Email профилья</label>
                <v-text-field
                    disabled
                    class="mb-4"
                    hide-details
                    :label="this.user.email"
                ></v-text-field>
                <label class="subtitle-1 ml-3 mb-1">Роль профилья</label>
                <v-text-field
                    disabled
                    class="mb-4"
                    hide-details
                    :label="this.user.role"
                ></v-text-field>
            </v-card-text>
            <v-card-actions class="justify-end pa-4">
                <v-btn color="primary">Изменить</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                user: window.Laravel.auth,
            }
        },
        mounted() {
            console.log(this.user);
        }
    }
</script>

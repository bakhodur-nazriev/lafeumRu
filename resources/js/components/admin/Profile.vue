<template>
    <v-container>
        <v-card max-width="700">
            <v-list-item>
                <v-list-item-content>
                    <v-list-item-title class="headline">Мой профиль</v-list-item-title>
                    <v-list-item-avatar class="" height="auto" size="80" color="grey"></v-list-item-avatar>
                </v-list-item-content>
            </v-list-item>
            <v-card-text class="py-0">
                <label class="subtitle-2 font-weight-bold ml-3 mb-1">Имя профилья</label>
                <v-text-field class="mb-4" solo hide-details></v-text-field>
                <label class="subtitle-2 font-weight-bold ml-3 mb-1">Email профилья</label>
                <v-text-field class="mb-4" solo hide-details></v-text-field>
                <label class="subtitle-2 font-weight-bold ml-3 mb-1">Роль профилья</label>
                <v-text-field class="mb-4" solo hide-details></v-text-field>
            </v-card-text>
            <v-card-actions class="justify-end pa-4">
                <v-btn color="primary">Изменить</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
    export default {
        //
    }
</script>

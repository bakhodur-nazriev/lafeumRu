<template>
    <div class="pa-3">
        <v-card
            tile
            width="800"
            elevation="0"
            class="mx-auto rounded-lg pa-3"
        >
            <v-col md="10" cols="12">

                <p class="py-1 grey--text caption">Фотография пользователя</p>
                <div class="d-flex align-center">

                    <v-avatar size="180">
                        <img
                            :src="userData.avatar"
                            :alt="userData.name"
                        >
                    </v-avatar>
                    <v-btn
                        depressed
                        color="primary"
                        class="text-capitalize rounded-lg mx-2"
                    >
                        Изменить аватарку
                    </v-btn>
                    <v-btn
                        depressed
                        color="primary"
                        class="text-capitalize rounded-lg mx-2"
                    >
                        Удалить аватарку
                    </v-btn>
                </div>
            </v-col>
            <v-col
                md="10"
                cols="12"
            >
                <div>
                    <p class="py-1 grey--text caption">Полное имя пользователя*</p>
                </div>
                <div class="d-flex">
                    <v-text-field
                        solo
                        flat
                        dense
                        single-line
                        hide-details
                        :label="userData.name"
                        class="mr-4 rounded-lg"
                        placeholder="Placeholder"
                        background-color="grey lighten-2"
                    ></v-text-field>
                    <v-btn color="primary" depressed class="text-capitalize rounded-lg">Изменить</v-btn>
                </div>
            </v-col>
            <v-col
                md="10"
                cols="12"
            >
                <div>
                    <p class="grey--text py-1 caption">Адрес E-mail</p>
                </div>
                <div class="d-flex">
                    <v-text-field
                        solo
                        flat
                        dense
                        hide-details
                        :label="userData.email"
                        class="mr-4 rounded-lg"
                        placeholder="Placeholder"
                        background-color="grey lighten-2"
                    ></v-text-field>
                    <v-btn color="primary" depressed class="text-capitalize rounded-lg">Изменить</v-btn>
                </div>
            </v-col>
            <v-col
                md="10"
                cols="12"
            >
                <div>
                    <p class="grey--text py-1 caption">Пароль</p>
                </div>
                <div class="d-flex">
                    <v-text-field
                        solo
                        flat
                        dense
                        hide-details
                        :label="userData.password"
                        class="mr-4 rounded-lg"
                        placeholder="Placeholder"
                        background-color="grey lighten-2"
                    ></v-text-field>
                    <v-btn color="primary" depressed class="text-capitalize rounded-lg">Изменить</v-btn>
                </div>
            </v-col>
            <v-col
                md="10"
                cols="12"
                class="d-flex"
            >
                <div class="mr-4">
                    <p class="grey--text py-1 caption">Возрасть</p>
                    <div class="d-flex">
                        <v-text-field
                            solo
                            flat
                            dense
                            hide-details
                            type="number"
                            :label="userData.age"
                            class="rounded-lg mr-4"
                            placeholder="Placeholder"
                            background-color="grey lighten-2"
                        ></v-text-field>
                        <v-btn depressed color="primary" class="text-capitalize rounded-lg">Изменить</v-btn>
                    </div>
                </div>

                <div>
                    <p class="grey--text py-1 caption">Пол</p>
                    <div class="d-flex">
                        <v-select
                            solo
                            flat
                            dense
                            hide-details
                            :label="userData.gender"
                            class="mr-4 rounded-lg"
                            background-color="grey lighten-2"
                        ></v-select>
                        <v-btn depressed color="primary" class="text-capitalize rounded-lg">Изменить</v-btn>
                    </div>
                </div>
            </v-col>
            <v-col
                md="10"
                cols="12"
            >
                <div>
                    <p class="grey--text py-1 caption">Хобби</p>
                </div>
                <div class="d-flex">
                    <v-textarea
                        flat
                        solo
                        rows="4"
                        :value="userData.hobby"
                        class="rounded-lg mr-4"
                        placeholder="Placeholder"
                        background-color="grey lighten-2"
                    ></v-textarea>
                    <v-btn color="primary" depressed class="text-capitalize rounded-lg">Изменить</v-btn>
                </div>
            </v-col>
        </v-card>
    </div>
</template>

<script>
export default {
    props: ["userData"],
    name: "Profile",
}
</script>

<style scoped>

</style>

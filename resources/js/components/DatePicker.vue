<template>
    <v-dialog
        ref="dialog"
        v-model="modalDate"
        v-if="modalDate"
        :return-value.sync="newPhoto.created_at"
        persistent
        width="290px"
    >
        <template v-slot:activator="{ on }">
            <v-text-field
                v-model="newPhoto.created_at"
                label="Выберите дату"
                prepend-inner-icon="mdi-calendar"
                readonly
                outlined
                v-on="on"
                hide-details
            ></v-text-field>
        </template>
        <v-date-picker v-model="newPhoto.created_at" scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="modalDate = false">Отмена</v-btn>
            <v-btn
                text
                color="primary"
                @click="$refs.dialog.save(newPhoto.created_at)"
            >
                OK
            </v-btn>
        </v-date-picker>
    </v-dialog>
</template>

<script>
    export default {
        data() {
            return {
                modalDate: false,
                addCreated_at: false
            }
        }
    }
</script>

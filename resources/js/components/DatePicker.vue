<template>
    <v-dialog
        ref="dialog"
        width="290px"
        color="primary"
        v-model="dialog"
        :return-value.sync="modalDate"
    >
        <template v-slot:activator="{ on }">
            <v-text-field
                readonly
                outlined
                v-on="on"
                :label="label"
                :value="modalDate"
                prepend-inner-icon="mdi-calendar"
            />
        </template>
        <v-date-picker scrollable v-model="modalDate">
            <v-spacer/>
            <v-btn text color="primary" @click="dialog = false">Отмена</v-btn>
            <v-btn text color="primary" @click="$refs.dialog.save(value)">OK</v-btn>
        </v-date-picker>
    </v-dialog>
</template>

<script>
    export default {
        props: {
            value: String,
            label: String
        },
        data() {
            return {
                dialog: false,
            }
        },
        computed: {
            modalDate: {
                get() {
                    return this.value;
                },
                set(v) {
                    this.$emit('input', v);
                }
            }
        },
        /*watch: {
            value(v){
                this.modalDate = v;
            },
            modalDate(v){
                this.$emit("input", v);
            }
        }*/
    }
</script>

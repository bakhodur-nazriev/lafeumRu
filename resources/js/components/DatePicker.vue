<template>
    <v-dialog
        ref="dialog"
        width="290px"
        color="primary"
        v-model="dialog"
        :return-value.sync="dateTime"
    >
        <template v-slot:activator="{ on }">
            <v-text-field
                dense
                readonly
                outlined
                v-on="on"
                :label="label"
                :value="dateTime"
                prepend-inner-icon="mdi-calendar"
            />
        </template>
        <v-date-picker scrollable v-model="date" flat elevation="0">
            <div class="w-100 px-3">
                <time-picker v-if="withTime" v-model="time"/>
                <v-row>
                    <v-spacer/>
                    <v-btn text color="primary" @click="dialog = false">Отмена</v-btn>
                    <v-btn
                        text
                        color="primary"
                        @click="$refs.dialog.save(value)"
                    >
                        OK
                    </v-btn>
                </v-row>
            </div>
        </v-date-picker>
    </v-dialog>
</template>

<script>
import TimePicker from './TimePicker.vue';

export default {
    props: {
        value: String,
        label: String,
        withTime: Boolean
    },
    components: {
        TimePicker
    },
    data() {
        return {
            dialog: false
        };
    },
    computed: {
        date: {
            get() {
                return this.dateTime ? this.dateTime.split(" ")[0] : "";
            },
            set(v) {
                if (!v) {
                    this.dateTime = "";
                    return;
                }

                let splitedDate = this.dateTime.split(" ");

                if (splitedDate.length > 1) {
                    this.dateTime = v + " " + splitedDate[1];
                    return;
                }

                this.dateTime = v;
            }
        },
        time: {
            get() {
                let splitedDate = this.dateTime.split(" ");

                if (splitedDate.length > 1) {
                    return splitedDate[1];
                }

                return '';
            },
            set(v) {

                let splitedDate = this.dateTime.split(" ");

                if (!v) {
                    this.dateTime = splitedDate[0];
                    return;
                }

                this.dateTime = splitedDate[0] + " " + v;
            }
        },
        dateTime: {
            get() {
                return this.value;
            },
            set(v) {
                this.$emit("input", v);
            }
        }
    },
    watch: {
        value(v) {
            this.dateTime = v;
        }
    }
};
</script>

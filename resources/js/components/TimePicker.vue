<template>
    <v-dialog
        ref="dialog"
        v-model="dialog"
        :return-value.sync="time"
        width="290px"
      >
        <template v-slot:activator="{ on }">
           <v-text-field
                outlined
                label="Часы"
                :value="time"
                prepend-inner-icon="mdi-clock"
                readonly
                v-on="on"
            />
        </template>
        <v-time-picker
            v-if="dialog"
            v-model="time"
            full-width
            format="24hr"
            @click:minute="$refs.dialog.save(time)"
        />
    </v-dialog>
</template>

<script>
export default {
    props: {
        value: String
    },
    data(){
        return {
            dialog: false
        }
    },
    computed: {
        time: {
            get() {
                return this.value;
            },
            set(v) {
                this.$emit('input', v);
            }
        }
    }
}
</script>
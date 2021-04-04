<template>
    <v-col cols="5">
        <h5 class="text-uppercase font-weight-regular py-4 mx-4">Термины</h5>
        <term-item :all-terms="allTerms"></term-item>
    </v-col>
</template>

<script>
import TermItem from "./layouts/TermItem";

export default {
    props: ["terms"],
    components: {TermItem},
    name: "Terms",
    data() {
        return {
            allTerms: this.terms
        }
    }
}
</script>

<style scoped>

</style>

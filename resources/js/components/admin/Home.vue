<template>
    <v-content class="pa-0">
        <draggable
            v-bind="dragOptions"
            tag="div"
            class="item-container"
            :list="list"
            :value="value"
            @input="emitter"
        >
            <div class="item-group" :key="el.id" v-for="el in realValue">
                <div class="item">{{ el.name }}</div>
                <nested-test class="item-sub" :list="el.elements"/>
            </div>
        </draggable>
    </v-content>
</template>

<script>
    import draggable from "vuedraggable";

    export default {
        namespaced: true,
        name: "nested-test",
        components: {draggable},
        props: {
            value: {
                required: false,
                type: Array,
                default: null
            },
            list: {
                required: false,
                type: Array,
                default: null
            }
        },
        data() {
            return {
                state: {
                    elements: [
                        {
                            id: 1,
                            name: "Shrek",
                            elements: []
                        },
                        {
                            id: 2,
                            name: "Fiona",
                            elements: [
                                {
                                    id: 4,
                                    name: "Lord Farquad",
                                    elements: []
                                },
                                {
                                    id: 5,
                                    name: "Prince Charming",
                                    elements: []
                                }
                            ]
                        },
                        {
                            id: 3,
                            name: "Donkey",
                            elements: []
                        }
                    ]
                },
                mutations: {
                    updateElements: (state, payload) => {
                        state.elements = payload;
                    }
                },
                actions: {
                    updateElements: ({commit}, payload) => {
                        commit("updateElements", payload);
                    }
                }
            };
        },
        computed: {
            dragOptions() {
                return {
                    animation: 0,
                    group: "description",
                    disabled: false,
                    ghostClass: "ghost"
                };
            },
            realValue() {
                return this.value ? this.value : this.list;
            },
            elements: {
                get() {
                    return this.state.nested.elements;
                },
                set(value) {
                    this.dispatch("nested/updateElements", value);
                }
            }
        },
        methods: {
            emitter(value) {
                this.$emit("input", value);
            }
        }
    };
</script>

<style scoped>
    .item-container {
        max-width: 20rem;
        margin: 0;
    }

    .item {
        padding: 1rem;
        border: solid black 1px;
        background-color: #fefefe;
    }

    .item-sub {
        margin: 0 0 0 1rem;
    }
</style>

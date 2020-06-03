<template>
    <Tree v-model="localTreeData" :ondragstart="dragStart" :ondragend="dragEnd">
        <div
            class="category-tree-node"
            :style="{ cursor: 'pointer' }"
            slot-scope="{ node, tree, path }"
            @click="if (!dragging) $emit('node-click', node)"
        >
            <v-btn
                v-if="node.children.length"
                icon
                x-small
                color="black"
                @click.stop="tree.toggleFold(node, path)"
            >
                <v-icon small>{{
                    node.$folded ? "mdi-chevron-down" : "mdi-chevron-up"
                }}</v-icon>
            </v-btn>
            <span>
                {{ node[itemText] }}
            </span>
        </div>
    </Tree>
</template>

<script>
import "he-tree-vue/dist/he-tree-vue.css";
import { Tree, Draggable, Fold, foldAll, getPureTreeData } from "he-tree-vue";

export default {
    props: {
        treeData: Array,
        itemText: String
    },
    components: {
        Tree: Tree.mixPlugins([Draggable, Fold])
    },
    data() {
        return {
            localTreeData: [],
            dragging: false
        };
    },
    mounted(){
        this.setTreeData([...this.treeData]);
    },
    methods: {
        getTree() {
            return getPureTreeData(this.localTreeData);
        },
        setTreeData(data){
            this.localTreeData = data;
            foldAll(this.localTreeData);
        },
        dragStart(tree, e) {
            this.dragging = true;
        },
        dragEnd(tree, e) {
            setTimeout(() => {
                this.dragging = false;
            }, 100);
        }
    },
    watch: {
        treeData(value){
            this.setTreeData(value);
        }
    }
};
</script>

<style>
.he-tree .tree-node {
    padding: 0;
}
.category-tree-node {
    padding: 5px;
}
</style>

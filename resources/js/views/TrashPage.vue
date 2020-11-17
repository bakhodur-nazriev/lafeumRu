<!--
<template>
    <v-main class="pa-0">
        <index-page-layout
            index-url="/api/feedbacks"
            :table-headers="this.headers"
            search-field="user_name"
            ref="indexPage"
            noActions
            @click:item="feedbackClick"
        >
            <template v-slot:item.message="{ item }">
                <p>
                    {{
                        item && item.message.length > 20
                            ? item.message.slice(0, 20) + '...'
                            : item.message
                    }}
                </p>
            </template>
        </index-page-layout>
        <v-dialog v-model="feedbackDialog" width="600">
            <v-card v-if="feedbackDialog">
                <v-card-title class="headline pr-2">
                    Обратная связь
                </v-card-title>

                <v-card-text>
                    <p><strong>Имя:</strong></p>
                    <p><strong>Email:</strong></p>
                    <p><strong>Тема:</strong></p>
                    <p><strong>Добавлено:</strong></p>
                    <p><strong>Сообщение:</strong></p>
                </v-card-text>

                <v-card-actions>
                    <v-spacer/>
                    <v-btn
                        color="primary darken-1"
                        text
                        @click="feedbackDialog = null"
                    >
                        Закрыть
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-main>
</template>

<script>
import IndexPageLayout from "../components/IndexPageLayout";

export default {
    component: {
        IndexPageLayout
    },
    data() {
        return {
            header: []
        }
    }
}

</script>
-->

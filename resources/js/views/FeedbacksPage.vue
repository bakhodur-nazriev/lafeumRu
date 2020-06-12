<template>
    <v-content class="pa-0">
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
                    <p>
                        <b>Имя:</b> {{feedbackToShow.user_name}}
                    </p>
                    <p>
                        <b>Email:</b> {{feedbackToShow.user_email}}
                    </p>
                    <p>
                        <b>Тема:</b> {{feedbackToShow.topic}}
                    </p>
                    <p>
                        <b>Добавлено:</b> {{feedbackToShow.created_at}}
                    </p>
                    <p><b>Сообщение:</b></p>
                    <p>{{feedbackToShow.message}}</p>
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
    </v-content>
</template>

<script>
import IndexPageLayout from "../components/IndexPageLayout";

export default {
    components: {
        IndexPageLayout
    },
    data() {
        return {
            feedbackDialog: false,
            feedbackToShow: null,
            headers: [
                {
                    text: "Имя",
                    value: "user_name",
                    align: "center"
                },
                {
                    text: "Email",
                    value: "user_email",
                    align: "center"
                },
                {
                    text: "Тема",
                    value: "topic",
                    align: "center"
                },
                {
                    text: "Сообщение",
                    value: "message",
                    align: "center"
                },
                {
                    text: "Добавлено",
                    value: "created_at",
                    align: "center"
                }
            ]
        };
    },
    methods: {
        feedbackClick(feedback){
            this.feedbackToShow = feedback;
            this.feedbackDialog = true;
        }
    }
};
</script>

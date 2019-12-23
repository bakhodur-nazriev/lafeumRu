<template>
  <v-app id="inspire">
    <v-content>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">
              <v-toolbar color="primary" dark flat>
                <v-toolbar-title>Форма входа</v-toolbar-title>
                <v-spacer />
              </v-toolbar>
              <v-card-text>
                <v-form :action="this.route" method="POST">
                  <v-text-field
                    label="Логин"
                    name="login"
                    prepend-icon="mdi-account"
                    type="text"
                    v-model="email"
                    :rules="[rules.required, rules.email]"
                  />

                  <v-text-field
                    id="password"
                    label="Пароль"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                    v-model="password"
                    :rules="[rules.required]"
                  />

                  <v-card-actions>
                    <v-btn text color="primary">Забыль пароль!</v-btn>
                    <v-spacer />
                    <v-btn color="primary" type="submit">вход</v-btn>
                  </v-card-actions>
                </v-form>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
export default {
  props: ["login"],
  data() {
    return {
      password: "",
      email: "",
      rules: {
        required: value => !!value || "Пожалуйста заполните поле!",
        email: value => {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return pattern.test(value) || "Не правильный email!";
        }
      }
    };
  }
};
</script>

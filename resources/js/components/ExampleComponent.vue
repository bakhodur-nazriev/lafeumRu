<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>

          <div class="card-body">
            <v-app>
              <v-alert color="success">
                I'm a success alert.
              </v-alert>

              <v-alert type="info">
                I'm an info alert.
              </v-alert>

              <v-alert type="warning">
                I'm a warning alert.
              </v-alert>

              <v-alert type="error">
                I'm an error alert.
              </v-alert>
            </v-app>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>

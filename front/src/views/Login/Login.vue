<template>
  <div id="login-view">
    <router-view></router-view>
    <footer-component />
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

import FooterComponent from "@/components/Footer.vue";

@Component({ components: { "footer-component": FooterComponent } })
export default class LoginView extends Vue {}
</script>

<style scoped>
#login-view {
  width: 100%;
}
</style>

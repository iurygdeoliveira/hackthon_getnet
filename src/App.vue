<template>
  <div id="app">
    <header-component />
    <router-view></router-view>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

import HeaderComponent from "@/components/Header.vue";

@Component({
  components: { "header-component": HeaderComponent },
})
export default class App extends Vue {}
</script>

<style>
#app {
  height: 100vh;
  width: 100vw;
  overflow-x: hidden;
}

.phone-hidden {
  display: none;
}

@media only screen and (min-width: 768px) {
  .phone-only {
    display: none;
  }

  .phone-hidden {
    display: initial;
  }
}
</style>

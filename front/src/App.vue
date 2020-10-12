<template>
  <div id="app">
    <header-component />
    <router-view></router-view>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

import HeaderComponent from "@/components/Header.vue";
import Axios from "axios";

@Component({
  components: {
    "header-component": HeaderComponent,
  },
})
export default class App extends Vue {
  // mounted() {
  //   setTimeout(() => this.$store.dispatch("setLoad"), 100);
  // }
}
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

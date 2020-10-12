<template>
  <div id="vendas-view">
    <router-view></router-view>
    <footer-component />
  </div>
</template>

<style scoped>
#vendas-view {
  width: 100%;
  font-family: "IBM Plex Sans", sans-serif;
}
</style>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

import FooterCommponent from "@/components/Footer.vue";

import eventBus from "../../store/eventbus";

@Component({
  components: { "footer-component": FooterCommponent },
})
export default class VendasView extends Vue {}
</script>

<style scoped></style>

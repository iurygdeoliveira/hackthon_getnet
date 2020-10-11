<template>
  <div id="pagamento-view">
    <router-view></router-view>
    <footer-component />
  </div>
</template>

<script>
import { Component, Vue } from "vue-property-decorator";

import FooterComponent from "@/components/Footer.vue";

@Component({
  components: { "footer-component": FooterComponent },
})
export default class PagamentoView extends Vue {}
</script>

<style scoped>
#pagamento-view {
  font-family: "IBM Plex Sans", sans-serif;
  width: 100%;
}

</style>

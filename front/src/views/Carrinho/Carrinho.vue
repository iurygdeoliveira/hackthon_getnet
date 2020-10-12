<template>
  <div id="carrinho-view">
    <router-view></router-view>
    <footer-component />
  </div>
</template>

<style scoped>
#carrinho-view {
  width: 100%;
  font-family: "IBM Plex Sans", sans-serif;
}

#title {
  font-size: 23px;
  font-weight: bold;
}

#item-text {
  font-size: 12px;
}

#item-description {
  min-width: 150px;
  opacity: 0.5;
}

#itens-list {
  margin-top: 30px;
}

#carrinho-view-content {
  padding: 6vw;
}

.item {
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
  padding: 2vw;
  border-bottom: solid 1px rgba(0, 0, 0, 0.3);
}

#price {
  align-self: flex-end;
  min-width: 80px;
  color: #17c261;
}

#total {
  margin: 0 0 20px;
  font-size: 36px;
  font-weight: bold;
}

#pag-title {
  font-size: 20px;
  font-weight: bold;
}

#mets-list {
  color: white;
  font-size: 20px;
  line-height: 20px;
  padding: 6vw 0;
}

.met-item {
  margin: 10px 0;
  background-color: #f20505;
  padding: 10vw;
  border-radius: 15px;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}
</style>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

import FooterComponent from "@/components/Footer.vue";
import eventBus from "../../store/eventbus";

@Component({
  components: { "footer-component": FooterComponent },
})
export default class CarrinhoView extends Vue {}
</script>

<template>
  <div id="vendas-add-view">
    <div class="sub-title">Adicionar ao carrinho:</div>
    <div id="row">
      <b-form
        style="display: flex; flex-wrap: wrap; margin-bottom: 30px; margin-right: 0; justify-content: space-evenly; width: 80%"
      >
        <div class="ipt-group">
          <label for="ipt-1">Nome</label>
          <b-input v-model="vendasInfo.name" id="ipt-1" />
        </div>
        <div class="ipt-group">
          <label for="ipt-2">Data</label>
          <b-input id="ipt-2" />
        </div>
        <div class="ipt-group">
          <label for="ipt-3">Descrição</label>
          <b-input v-model="vendasInfo.description" id="ipt-3" />
        </div>
        <div class="ipt-group">
          <label for="ipt-4">Valor</label>
          <b-input v-model="vendasInfo.amount" id="ipt-4" />
        </div>
      </b-form>
      <img
        @click.prevent="newCartItem"
        width="50px"
        src="../../../public/SPOILER_Adiicionar.svg"
        alt=""
      />
    </div>
    <b-button @click.prevent="goTo('/carrinho')" id="ok-venda"
      >Concluir venda</b-button
    >
  </div>
</template>

<style scoped>
#vendas-add-view {
  font-family: "IBM Plex Sans", sans-serif;
  width: 100%;
  padding: 4vw 8vw;
}

.ipt-group {
  margin: 10px;
  width: 40%;
}

#row {
  display: flex;
  justify-content: space-between;
}

.ipt-group input {
  background-color: #e2e2e2;
}

.sub-title {
  font-size: 16px;
  margin-bottom: 30px;
}

#ok-venda {
  font-size: 20px;
  display: flex;
  margin: 60px auto;
  background-color: #17c261;
}
</style>

<script lang="ts">
import Axios from "axios";
import { Component, Vue } from "vue-property-decorator";

import eventBus from "../../store/eventbus";

@Component({})
export default class VendasAddView extends Vue {
  vendasInfo = {
    name: "",
    description: "",
    amount: "",
  };

  async newCartItem() {
    this.vendasInfo["id"] = new Date().getTime();
    const newItem = this.vendasInfo;
    await this.$store.dispatch("addItemCart", {
      data: newItem,
    });
    this.vendasInfo = {
      name: "",
      description: "",
      amount: "",
    };
  }

  goTo(route: string) {
    this.$router.push(route);
  }

  sleep(ms: number): Promise<void> {
    return new Promise((res) => setTimeout(res, ms));
  }
}
</script>

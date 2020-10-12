<template>
  <div id="vendas-view-content">
    <div id="main-org">
      <div style="text-align: center;">
        <label style="margin: 0; ">Vendas</label>
        <div id="vendas-total">
          R$ 1180,50
        </div>
      </div>
      <b-button id="go-venda" @click.prevent="goTo('/vendas/adicionar')"
        >Realizar Vendas</b-button
      >
    </div>
    <div id="list-vendas">
      <a href="" id="xpnd-link">
        <hr id="xpnd-icon" />
      </a>
      <div id="list-vendas-title">
        Vendas Recentes:
      </div>
      <div id="list-container">
        <div class="item" v-for="item in vendasItens" :key="item.nome">
          <div id="item-img">
            <img src="https://picsum.photos/40?grayscale" alt="" />
          </div>
          <div id="item-text">
            <div id="item-title">
              <strong>{{ item.nome }}</strong>
            </div>
            <div id="item-description">{{ item.desc }}</div>
          </div>
          <div id="price">R$ {{ item.valor }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
#vendas-total-view {
  font-family: "IBM Plex Sans", sans-serif;
}

#main-org {
  display: flex;
  flex-direction: column;
  padding: 10vw;
}

#vendas-total {
  width: auto;
  font-size: 34px;
  font-weight: bolder;
}

#go-venda {
  margin: auto;
  margin-top: 20px;
  background-color: #17c261;
  font-size: 20px;
  padding: 2vw;
  width: 200px;
}

#list-vendas {
  padding: 1vw 8vw 3vw;
  background-color: #f9f2f3;
  border-radius: 25px 25px 0 0;
}

#xpnd-icon {
  width: 30px;
  border-top: 6px solid rgba(0, 0, 0, 0.1);
  border-radius: 30%;
}

#list-vendas-title {
  font-size: 20px;
  margin: 20px 0;
}

.item {
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
  padding: 2vw;
}

#item-text {
  font-size: 14px;
}

#item-description {
  min-width: 150px;
  max-width: 150px;
  opacity: 0.5;
}

#price {
  font-size: 14px;
  align-self: flex-end;
  min-width: 80px;
  color: #17c261;
}
</style>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

@Component({})
export default class VendasTotalView extends Vue {
  vendasItens = [
    {
      nome: "Ana Carolina",
      desc: "Kit festa - bolo 1kg",
      valor: "150,00",
      show: true,
    },
    {
      nome: "Risa Midyett",
      desc: "Bolo vulcão - 1kg",
      valor: "49,00",
      show: true,
    },
    {
      nome: "João",
      desc: "Kit com 6 brigadeiros",
      valor: "6,95",
      show: true,
    },
  ];

  goTo(route: string) {
    this.$router.push(route);
  }
}
</script>

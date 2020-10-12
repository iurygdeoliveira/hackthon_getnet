<template>
  <div id="carrinho-add-view">
    <div id="itens-list">
      <div class="item" v-for="item in cartItens" :key="item.title">
        <div id="item-img">
          <img src="https://picsum.photos/30?grayscale" alt="" />
        </div>
        <b-icon icon="caret-right-fill" style="color: #A61731;"></b-icon>
        <div id="item-text">
          <div id="item-title">
            <strong>{{ item.title }}</strong>
          </div>
          <div id="item-description">{{ item.desc }}</div>
        </div>
        <div style="display: flex; flex-direction: column;">
          <img
            @click.prevent="deleteItem(item.id)"
            width="20px"
            style="margin: auto;"
            src="../../../public/lixo.svg"
          />
          <div id="price">R$ {{ item.price }}</div>
        </div>
      </div>
      <b-button
        @click.prevent="goTo('/carrinho')"
        style="display: flex; margin: 60px auto; background-color: #17C261"
        >Concluir venda</b-button
      >
    </div>
  </div>
</template>

<style scoped>
#carrinho-add-view {
  padding: 8vw;
  font-size: 13px;
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

.item {
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
  padding: 2vw;
  margin-top: 10px;
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
</style>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

@Component({})
export default class CarrinhoAddView extends Vue {
  // cartItens = [
  //   { price: "60,00", title: "Bolo", desc: "Bolo sabor chocolate - 1kg" },
  //   { price: "40,00", title: "Docinhos", desc: "1 cento de docinhos" },
  // ];

  cartItens = [];

  async mounted() {
    this.cartItens = await this.$store.getters["getCart"];

    this.cartItens = this.cartItens.map((el) => {
      return {
        price: el.amount,
        desc: el.description,
        title: el.name,
        id: el.id,
      };
    });
  }

  async deleteItem(id: number) {
    this.$store.dispatch("removeItemCart", { id });
    this.cartItens = await this.$store.getters["getCart"];
  }

  getTotal() {
    return this.cartItens
      .map((el) => Number(el.price.replace(",", ".")))
      .reduce((acc, el) => acc + el)
      .toFixed(2)
      .replace(".", ",");
  }

  goTo(route: string) {
    this.$router.push(route);
  }
}
</script>

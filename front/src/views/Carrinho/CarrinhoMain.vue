<template>
  <div id="carrinho-view-content">
    <div id="title">
      Carrinho:
      <img
        @click.prevent="goTo('/carrinho/adicionar')"
        style="margin-left: 170px;"
        width="35px"
        src="../../../public/SPOILER_Adiicionar.svg"
        alt=""
      />
    </div>
    <!-- Listagem definida esclusivamente pelo Estado global  -->
    <div id="itens-list">
      <div class="item" v-for="item in cartItens" :key="item.id">
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
        <div id="price">R$ {{ item.price }}</div>
      </div>
      <label style="margin: 0; margin-top: 30px; opacity: 0.6;">Total</label>
      <div id="total">R$ {{ getTotal() }}</div>
    </div>
    <div id="metodos-pag">
      <div id="pag-title">
        Selecione o tipo de Pagamento:
      </div>
      <div id="mets-list">
        <div class="met-item" @click.prevent="goTo('/pagamento/cartao')">
          <b-icon icon="credit-card-fill" />
          <div class="item-title">Débito / Crédito</div>
          <b-icon icon="arrow-right" />
        </div>
        <div class="met-item" @click.prevent="goTo('/pagamento/qrcode')">
          <b-icon icon="credit-card-fill" />
          <div class="item-title">
            QR Code
          </div>
          <b-icon icon="arrow-right" />
        </div>
        <div class="met-item" @click.prevent="goTo('/pagamento/link')">
          <b-icon icon="credit-card-fill" />
          <div class="item-title">
            Link
          </div>
          <b-icon icon="arrow-right" />
        </div>
        <div class="met-item" @click.prevent="goTo('/pagamento/dinheiro')">
          <b-icon icon="credit-card-fill" />
          <div class="item-title">Dinheiro</div>
          <b-icon icon="arrow-right" />
        </div>
      </div>
    </div>
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
  font-size: 17px;
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

@Component({})
export default class CarrinhoMainView extends Vue {
  cartItens: Array<any> = [];

  async mounted() {
    this.cartItens = await this.$store.getters["getCart"];
    // this.cartItens = this.$store.state["cart"] as Array<any>;

    this.cartItens = this.cartItens.map((el) => {
      return {
        price: el.amount,
        desc: el.description,
        title: el.name,
        id: el.id,
      };
    });
  }

  async getCartItems() {
    return await this.$store.getters["getCart"].map((el) => {
      return {
        price: el.amount,
        desc: el.description,
        title: el.name,
        id: el.id,
      };
    });
  }

  getTotal() {
    return this.cartItens.length > 0
      ? this.cartItens
          .map((el) => Number(el.price.replace(",", ".")))
          .reduce((acc, el) => acc + el)
          .toFixed(2)
          .replace(".", ",")
      : "";
  }

  goTo(route: string) {
    this.$router.push(route);
  }
}
</script>

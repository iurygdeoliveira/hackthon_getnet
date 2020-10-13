<template>
  <div id="pagamento-cartao-view">
    <a ref="iframeOn" class="pay-button-getnet">Finalizar</a>
    <script
      async
      type="application/javascript"
      src="https://checkout-sandbox.getnet.com.br/loader.js"
      data-getnet-sellerid="338f404e-45bc-4d6b-8d21-0d27d1b2ab67"
      :data-getnet-token="`Bearer ${config.token}`"
      data-getnet-amount="25.00"
      data-getnet-customerid="12345"
      data-getnet-orderid="12345"
      data-getnet-button-class="pay-button-getnet"
      data-getnet-installments="4"
      data-getnet-customer-first-name="João"
      data-getnet-customer-last-name="da Silva"
      data-getnet-customer-document-type="CPF"
      data-getnet-customer-document-number="22233366638"
      data-getnet-customer-email="teste@getnet.com.br"
      data-getnet-customer-phone-number="1134562356"
      data-getnet-customer-address-street="Rua Alexandre Dumas"
      data-getnet-customer-address-street-number="1711"
      data-getnet-customer-address-complementary=""
      data-getnet-customer-address-neighborhood="Chacara Santo Antonio"
      data-getnet-customer-address-city="São Paulo"
      data-getnet-customer-address-state="SP"
      data-getnet-customer-address-zipcode="04717004"
      data-getnet-customer-country="Brasil"
      data-getnet-url-callback="/vendas"
      :data-getnet-items="config.itens"
      data-getnet-pre-authorization-credit=""
    ></script>
  </div>
</template>

<script lang="ts">
import Axios from "axios";
import { Component, Vue } from "vue-property-decorator";

@Component({})
export default class PagamentoCartaoView extends Vue {
  $refs: {
    iframeOn: HTMLLinkElement;
  };

  config = {
    token: "f71caacd-0363-49ff-a33c-346a8116369a",
    amount: "",
    sellerid: "",
    customerid: "",
    orderid: "",
    btnclass: "",
    customer1name: "",
    customer2name: "",
    cpf: "",
    customeremail: "",
    country: "",
    cep: "",
    addressState: "",
    addressCity: "",
    addressBairro: "",
    addressSt: "",
    addressStN: "",
    itens: [],
    ready: true,
  };

  async mounted() {
    this.config.itens = this.$store.getters["getCart"];
    this.config.itens.map((el) => {
      return {
        value: Number(el.amount),
        description: el.description,
        quantity: 1,
        name: el.name,
        sku: (el.id as number).toString(),
      };
    });

    console.log(this.config.itens);

    try {
      const resp = await Axios.get(
        this.$store.getters["serverURL"] + "/authentication"
      );

      this.config.token = resp.data;
      console.log(this.config.token);
    } catch (error) {
      console.error(error);
    }

    this.$refs.iframeOn.click();
  }
}
</script>

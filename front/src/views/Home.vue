<template>
  <div id="home-view">
    <div class="card" id="main-card">
      <div class="card-text" id="main-card-text">
        Organize as finança de seu negócio com facilidade em qualquer lugar
        <b-button class="comecar-btn">
          <router-link to="cadastro">
            Começar agora
          </router-link>
        </b-button>
      </div>
      <img src="../../public/NOTRE_DAME.svg" alt="" id="main-card-img" />
    </div>
    <div class="card">
      <div class="card-text" id="msg-1">
        Tudo muito Fácil, Rápido e Seguro!
      </div>
    </div>
    <div class="card" id="cards">
      <b-card-group style="width: 100%; display: flex; padding: 8vw 1px" deck>
        <b-card
          border-variant="light"
          img-top
          no-body
          style="width: 32%; margin: auto; margin-top: 0; font-size: 13px; text-align: center;"
        >
          <b-card-body style="padding: 0;">
            <b-card-img top src="./MEIO1.svg" />
            <b-card-text style="margin-top: 15px;">
              <strong> Acesso online</strong><br />
              Acesse a nossa plataforma e descubra.</b-card-text
            >
          </b-card-body>
        </b-card>
        <b-card
          border-variant="light"
          img-top
          no-body
          style="width: 32%; margin: auto; margin-top: 0; font-size: 13px; text-align: center;"
        >
          <b-card-body style="padding: 0;">
            <b-card-img top src="./MEIO2.svg" />
            <b-card-text style="margin-top: 15px;">
              <strong> Uso simples</strong><br />
              Acesse a qualquer momento e realize suas vendas!</b-card-text
            >
          </b-card-body>
        </b-card>
        <b-card
          border-variant="light"
          img-top
          no-body
          style="width: 32%; margin: auto; margin-top: 0; font-size: 13px; text-align: center;"
        >
          <b-card-body style="padding: 0;">
            <b-card-img top src="./MEIO3.svg" />
            <b-card-text style="margin-top: 15px;">
              <strong> Controle financeiro</strong><br />
              Acesse a nossa plataforma e descubra como.</b-card-text
            >
          </b-card-body>
        </b-card>
      </b-card-group>
    </div>
    <div class="card" id="big-img">
      <img src="../../public/ft.png" alt="" />
    </div>
    <div class="card" id="register">
      <b-form style="margin-right: 10px;">
        <div style="text-align: center;">Crie a sua conta</div>
        <label class="" for="inline-form-input-name">Nome</label>
        <b-input
          id="inline-form-input-name"
          class="mb-2 mr-sm-2 mb-sm-0"
        ></b-input>
        <label class="" for="inline-form-input-username">E-mail</label>
        <b-input id="inline-form-input-username"></b-input>
        <b-button class="comecar-btn">Iniciar cadastro</b-button>
      </b-form>
      <img src="../../public/CARINHA_DA_MAQUININHA.svg" alt="" />
    </div>
    <footer-component />
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

import FooterComponent from "@/components/Footer.vue";

import {
  BButton,
  BCardGroup,
  BCard,
  BCardText,
  BCardImg,
  BForm,
  BFormInput,
} from "bootstrap-vue";

@Component({
  components: { "footer-component": FooterComponent },
})
export default class HomeView extends Vue {}
</script>

<style scoped>
#home-view {
  font-family: "IBM Plex Sans", sans-serif;
  width: 100%;
  height: 100%;
}

.card {
  font-size: 14px;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}

#main-card {
  padding: 8vw;
}

#main-card-text {
  display: flex;
  flex-direction: column;
  font-size: 14px;
  width: 50%;
  line-height: 25px;
  margin: auto 0;
}

.comecar-btn {
  margin: auto;
  margin-top: 10px;
  width: 120px;
  padding: 0;
  background-color: #f20505;
}

.comecar-btn > * {
  color: white;
  font-size: 15px;
}

#main-card-img {
  box-sizing: border-box;
}

#msg-1 {
  padding: 6vw 0;
  width: 100%;
  background-color: #a61731;
  color: white;
  text-align: center;
}

#cards {
  display: flex;
  flex-direction: row;
}

#cards img {
  max-width: min-content;
}

#big-img img {
  object-fit: cover;
  width: 100%;
  max-width: 100%;
}

#register {
  width: 100%;
  padding: 8vw 4vw;
  display: flex;
  justify-content: space-between;
}
</style>

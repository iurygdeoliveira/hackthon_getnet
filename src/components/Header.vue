<template>
  <div id="header-component">
    <div class="header-line" id="brand">
      <div style="flex-frow: 1; margin: auto; display: flex;">
        <img src="https://picsum.photos/40?grayscale" alt="" />
        <div class="line-el" id="nome-marca">+GRANA</div>
      </div>
      <div class="line-el phone-only" id="lgn-btn-p">
        <b-button id="login-btn">
          <router-link to="entrar">
            LOGIN
          </router-link>
        </b-button>
      </div>
    </div>
    <div class="header-line" id="nav-el">
      <div class="line-el">Serviços</div>
      <div class="line-el">Contato</div>
      <div class="line-el">Sobre</div>
      <div class="line-el phone-hidden" id="lgn-btn-p">
        <b-button id="login-btn">
          <router-link to="entrar">
            LOGIN
          </router-link>
        </b-button>
      </div>
    </div>
    <div class="back">
      <b-icon class="back-icon" icon="arrow-left" />
    </div>
    <button v-b-toggle.sidebar-1>adada</button>
    <b-sidebar
      id="sidebar-1"
      backdrop
      width="60%"
      visible
      right
      sidebar-class="rounded-left rounded-lg"
    >
      <template slot="header-close">
        <b-icon class="back-icon" style="color: #F20505;" icon="arrow-left" />
      </template>
      <div id="user-info">
        <img id="user-img" :src="userInfo.imgURL" alt="" />
        <div id="user-name">{{ userInfo.nome }}</div>
        <div id="user-email">{{ userInfo.email }}</div>
      </div>

      <div id="func-list">
        <div class="func-item">
          <div class="item-img">
            <img src="../../public/SPOILER_dinheiro_vermelhp.svg" alt="" />
          </div>
          <div class="item-text">RECEITA</div>
        </div>
        <div class="func-item">
          <div class="item-img">
            <img src="../../public/SPOILER_controle_gastos.svg" alt="" />
          </div>
          <div class="item-text">Controle de Gastos</div>
        </div>
        <div class="func-item">
          <div class="item-img">
            <img src="../../public/SPOILER_Adiicionar.svg" alt="" />
          </div>
          <div class="item-text">Adicionar Custos</div>
        </div>
        <div class="func-item">
          <div class="item-img">
            <img src="../../public/SPOILER_config.svg" alt="" />
          </div>
          <div class="item-text">Configurações</div>
        </div>
        <div class="func-item">
          <div class="item-img">
            <img src="../../public/SPOILER_sair.svg" alt="" />
          </div>
          <div class="item-text">Sair</div>
        </div>
      </div>
    </b-sidebar>
  </div>
</template>

<script>
import { Component, Vue } from "vue-property-decorator";

import { BButton, BSidebar } from "bootstrap-vue";

@Component({
  components: {},
})
export default class HeaderComponent extends Vue {
  userInfo = {
    imgURL: "https://picsum.photos/60?grayscale",
    nome: "Maria",
    email: "email@provedor.com",
  };
}
</script>

<style scoped>
#header-component {
  width: 100%;
  font-family: "IBM Plex Sans", sans-serif;
  padding: 5vw 0 0;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  flex-wrap: wrap;
  height: auto;
  background-color: #f2f2f2;
}

.sidebar-c {
  border: solid black 10px;
}

#brand {
  width: 100%;
  margin: auto;
  display: flex;
  justify-content: space-between;
}

#nav-el {
  flex-grow: 1;
  color: white;
  margin-top: 4vw;
  background-color: #f20505;
  width: 100%;
}

.header-line {
  margin: auto 0;
  display: flex;
  flex-direction: row;
  padding: 0 2vw;
  font-size: 20px;
  justify-content: space-between;
}

.line-el {
  margin: auto 0;
  text-align: left;
  font-family: "IBM Plex Sans", sans-serif;
  padding: 0 2vw;
}

#nome-marca {
  font-size: 15px;
  color: #f20505;
  font-weight: bold;
}

#login-btn {
  padding: 2px;
  background-color: #f20505;
  width: 80px;
}

#login-btn > * {
  color: white;
  font-size: 14px;
}

.back {
  padding: 2vw 4vw;
}

.back-icon {
  font-size: 20px;
  font-weight: bolder;
  color: #f20505;
}

#user-info {
  display: flex;
  flex-direction: column;
  padding: 6vw;
}

#user-img {
  width: min-content;
}

#user-name {
  font-size: 26px;
  font-weight: bold;
  margin: 10px 0;
}

#user-email {
  font-size: 16px;
  opacity: 0.4;
}

#func-list {
  padding: 6vw;
}

.func-item {
  display: flex;
  flex-direction: row;
  margin-bottom: 20px;
}

.item-text {
  font-size: 16px;
  text-align: center;
}

.item-img {
  margin-right: 10px;
}

@media only screen and (min-width: 768px) {
  #header-component {
    padding: 1vw;
  }

  #nome-marca {
    font-size: 25px;
  }

  .header-line {
    font-size: 20px;
    padding: 1vw;
  }

  #login-btn {
    padding: 5px;
    font-size: 20px;
    width: 130px;
  }

  #nav-el {
    flex-grow: 0;
    margin-top: 0;
    background-color: inherit;
    color: inherit;
    width: auto;
  }

  #brand {
    margin: 1vw;
  }
}
</style>

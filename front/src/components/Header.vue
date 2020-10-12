<template>
  <div id="header-component">
    <div class="header-line" id="brand">
      <div style="flex-frow: 1; margin: auto; display: flex;">
        <router-link to="/">
          <img width="45px" src="../../public/Logo_maquininha.svg" alt="" />
        </router-link>
        <div class="line-el" id="nome-marca">TopGrana</div>
      </div>
      <div class="line-el phone-only" id="lgn-btn-p">
        <b-button id="login-btn" v-if="!userInfo.isLogged">
          <router-link to="/entrar">
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
        <b-button id="login-btn" v-if="!userInfo.isLogged">
          <router-link to="entrar">
            LOGIN
          </router-link>
        </b-button>
      </div>
    </div>
    <div class="back">
      <b-icon class="back-icon" icon="arrow-left" @click.prevent="routeBack" />
    </div>
    <b-button variant="outline" v-b-toggle.sidebar-1 v-if="userInfo.isLogged">
      <b-icon icon="grid-fill" />
    </b-button>
    <b-sidebar
      id="sidebar-1"
      backdrop
      width="60%"
      right
      sidebar-class="rounded-left rounded-lg"
    >
      <template slot="header-close">
        <b-icon class="back-icon" style="color: #F20505;" icon="arrow-left" />
      </template>
      <div id="user-info">
        <img id="user-img" src="../../public/SPOILER_user.svg" alt="" />
        <div id="user-name">{{ userInfo.nome }}</div>
      </div>

      <div id="func-list">
        <div class="func-item">
          <div class="item-img">
            <img src="../../public/SPOILER_dinheiro_vermelhp.svg" alt="" />
          </div>
          <div class="item-text">
            <a @click.prevent v-b-modal.modal-lucro>
              Receita
            </a>
          </div>
        </div>
        <div class="func-item">
          <div class="item-img">
            <img src="../../public/SPOILER_controle_gastos.svg" alt="" />
          </div>
          <div class="item-text">
            <a @click.prevent v-b-modal.modal-gastos>Controle de Gastos</a>
          </div>
        </div>
        <div class="func-item">
          <div class="item-img">
            <img src="../../public/SPOILER_Adiicionar.svg" alt="" />
          </div>
          <div class="item-text">
            <a @click.prevent v-b-modal.modal-add-gastos>
              Adicionar Custos
            </a>
          </div>
        </div>
        <div class="func-item">
          <div class="item-img">
            <img src="../../public/SPOILER_config.svg" alt="" />
          </div>
          <div class="item-text">
            <a href="">
              Configurações
            </a>
          </div>
        </div>
        <div class="func-item">
          <div class="item-img">
            <img src="../../public/SPOILER_sair.svg" alt="" />
          </div>
          <div class="item-text">
            <a href="" @click.prevent="logout">
              Sair
            </a>
          </div>
        </div>
      </div>
    </b-sidebar>
    <b-modal centered id="modal-lucro" size="lg" ok-only no-stacking>
      <template slot="modal-title">
        <div class="md-title">Lucro mensal</div>
      </template>
      <img src="../../public/SPOILER_lucro_anual.svg" alt="" />
    </b-modal>
    <b-modal centered id="modal-gastos" size="lg" ok-only no-stacking>
      <template slot="modal-title">
        <div class="md-title">Gastos permitidos</div>
      </template>
      <div class="modal-img">
        <a @click.prevent v-b-modal.modal-add-gastos>
          <img
            style="margin-right: 0;"
            width="40px"
            src="../../public/SPOILER_Adiicionar.svg"
            alt=""
          />
        </a>
        <img src="../../public/SPOILER_gastos_permitidp.svg" alt="" />
      </div>
      <div class="sub-title">
        R$ 2000,00
      </div>
      <div id="gastos-rec">
        <div class="sub-title" style="text-align: left;">
          Gastos recentes:
        </div>
        <div id="list-container">
          <div class="item" v-for="item in gastosItens" :key="item.nome">
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
    </b-modal>
    <b-modal centered id="modal-add-gastos" size="lg" ok-only no-stacking>
      <template slot="modal-title">
        <div class="md-title">Adicionar gastos</div>
      </template>
      <div id="add-btn-img" style="display: flex;">
        <img
          style="margin: auto; margin-right: 0;"
          width="40px"
          src="../../public/SPOILER_Adiicionar.svg"
          alt=""
        />
      </div>
      <div id="n-g-form">
        <b-form style="display: flex; flex-wrap: wrap; margin-bottom: 30px;">
          <div class="ipt-group">
            <label for="ipt-1">Nome</label>
            <b-input id="ipt-1" />
          </div>
          <div class="ipt-group">
            <label for="ipt-2">Data</label>
            <b-input id="ipt-2" />
          </div>
          <div class="ipt-group">
            <label for="ipt-3">Descrição</label>
            <b-input id="ipt-3" />
          </div>
          <div class="ipt-group">
            <label for="ipt-4">Valor</label>
            <b-input id="ipt-4" />
          </div>
        </b-form>
      </div>
      <div class="sub-title" style="text-align: left;">Histórico</div>
      <div id="list-container">
        <div class="item" v-for="item in gHistItens" :key="item.nome">
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
    </b-modal>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

import { BButton, BSidebar } from "bootstrap-vue";

import eventBus from "../store/eventbus";

@Component({
  components: {},
})
export default class HeaderComponent extends Vue {
  logout() {
    this.$store.dispatch("logOut");
    this.$router.replace("/");
  }

  created() {
    this.userInfo = this.$store.getters["user"];
  }

  userInfo: any;

  gastosItens = [
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
  ];

  gHistItens = [
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
  ];

  routeBack() {
    this.$router.back();
  }
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

.item-text > a {
  color: unset;
  text-decoration: none;
}

.item-img {
  margin-right: 10px;
}

.md-title {
  font-size: 30px;
  font-weight: bold;
}

.modal-img {
  display: flex;
  flex-direction: column;
}

.modal-img a {
  display: inline-block;
  margin: auto;
  margin-right: 0;
}

.modal-img img {
  margin: auto;
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
  color: #f76654;
}

.sub-title {
  font-size: 25px;
  font-weight: bold;
  text-align: center;
  margin-bottom: 30px;
}

#list-container {
  margin-top: -10px;
}

#n-g-form input {
  background-color: #e2e2e2;
}

.ipt-group {
  margin: 10px;
  width: 40%;
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

<template>
  <div id="cadastro1-view">
    <div id="msg-2">
      Faça sua Inscrição
    </div>
    <div id="etapas" style="margin-top: 10px;">
      <img width="100%" src="../../../public/state_1.svg" alt="" />
    </div>
    <div id="form-cadastro-container">
      <b-form id="form-cadastro">
        <div
          class="input-container"
          style="display: flex; flex-direction: column;"
        >
          <label for="nome">Nome</label>
          <b-input v-model="registerInfo.name" class="input" id="nome">
          </b-input>
        </div>
        <div
          class="input-container"
          style="display: flex; flex-direction: column;"
        >
          <label for="cpf">CPF</label>
          <b-input v-model="registerInfo.cpf" class="input" id="cpf"> </b-input>
        </div>
        <div
          class="input-container"
          style="display: flex; flex-direction: column;"
        >
          <label for="email">E-mail</label>
          <b-input class="input" id="email"> </b-input>
        </div>
        <div
          class="input-container"
          style="display: flex; flex-direction: column;"
        >
          <label for="cel">Celular</label>
          <b-input v-model="registerInfo.phone" class="input" id="cel">
          </b-input>
        </div>
        <div
          class="input-container"
          style="display: flex; flex-direction: column;"
        >
          <label for="address">Endereço</label>
          <b-input class="input" id="address"> </b-input>
        </div>
        <div
          class="input-container"
          style="display: flex; flex-direction: column;"
        >
          <label for="password1">Digite uma senha</label>
          <b-input
            v-model="registerInfo.pass"
            class="input"
            id="password1"
            type="password"
          >
          </b-input>
        </div>
        <div
          class="input-container"
          style="display: flex; flex-direction: column;"
        >
          <label for="cep">CEP</label>
          <b-input class="input" id="cep"> </b-input>
        </div>
        <div
          class="input-container"
          style="display: flex; flex-direction: column;"
        >
          <label for="password2">Repita a senha</label>
          <b-input class="input" id="password2" type="password"> </b-input>
        </div>
        <div
          class="input-container"
          style="display: flex; flex-direction: column;"
        >
          <label for="estado">Estado</label>
          <b-input class="input" id="estado"> </b-input>
        </div>
        <b-button @click.prevent="register" class="comecar-btn">
          <!-- <router-link to="cadastro/etapa2"> -->
          Próxima etapa
          <!-- </router-link> -->
        </b-button>
      </b-form>
    </div>
  </div>
</template>

<style scoped>
#cadastro1-view {
  width: 100%;
  font-family: "IBM Plex Sans", sans-serif;
}

#form-cadastro-container {
  width: 100%;
  padding: 8vw 4vw;
}

#msg-2 {
  margin-top: 10px;
  padding: 8vw;
  text-align: center;
  color: white;
  background-color: #a61731;
}

.input-container {
  width: 45%;
}

#form-cadastro {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-between;
}

.comecar-btn {
  margin: auto;
  width: 130px;
  padding: 5px 1vw;
  background-color: #f20505;
}

.comecar-btn > * {
  color: white;
  font-size: 15px;
}
</style>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

import axios from "axios";

@Component({})
export default class Cadastro1View extends Vue {
  registerInfo = {
    name: "",
    pass: "",
    cpf: "",
    phone: "",
  };

  async register() {
    try {
      const resp = await axios.post(
        this.$store.getters["serverURL"] + "/register",
        this.registerInfo
      );
      this.$router.push("/cadastro/etapa2");
    } catch (error) {
      this.registerInfo.name = this.registerInfo.pass = this.registerInfo.cpf = this.registerInfo.phone =
        "";
    }
  }
}
</script>

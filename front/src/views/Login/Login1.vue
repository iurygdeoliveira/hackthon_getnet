<template>
  <div id="login1-view">
    <div id="bem-v-text"><strong>Bem vindo de volta!</strong></div>
    <div id="mascote-img">
      <img src="https://picsum.photos/180?grayscale" alt="" />
    </div>
    <b-form
      style="margin-right: 10px; display: flex; flex-direction: column; width: 100%; padding: 5vw 5vw 0;"
    >
      <b-input
        id="inline-form-input-name"
        class="mb-2 mr-sm-2 mb-sm-0"
        placeholder="CPF"
      ></b-input>
      <b-input
        type="password"
        id="inline-form-input-username"
        placeholder="Senha"
      ></b-input>
      <router-link class="forgot-pwd" to="entrar/recuperar"
        >Esqueceu a senha?</router-link
      >
      <b-button id="submit-btn">Login</b-button>
      <router-link class="cadastre-se" to="cadastro"
        >Ou, Cadastre-se agora</router-link
      >
    </b-form>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from "vue-property-decorator";

import FooterComponent from "@/components/Footer.vue";

@Component({
  components: { "footer-component": FooterComponent },
})
export default class Login1View extends Vue {
  navigateTo(route: string) {
    this.$router.replace(route);
  }
}
</script>

<style scoped>
#login1-view {
  font-family: "IBM Plex Sans", sans-serif;
  width: 100%;
  display: flex;
  padding: 8vw 4vw;
  flex-direction: column;
}

#bem-v-text {
  text-align: center;
}

#mascote-img {
  display: flex;
  width: 100%;
}

#mascote-img > img {
  margin: auto;
  margin-top: 10px;
  max-width: min-content;
}

.forgot-pwd {
  color: #f20505;
  display: inline-block;
  margin: 5px 0;
  text-align: right;
}

.cadastre-se {
  display: inline-block;
  margin: 5px 0;
  text-align: center;
}

#submit-btn {
  font-size: 20px;
  padding: 3vw;
  background-color: #f20505;
  margin: auto;
  margin-top: 20px;
  width: 70%;
}
</style>

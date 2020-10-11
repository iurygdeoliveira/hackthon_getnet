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
  </div>
</template>

<script>
import { Component, Vue } from "vue-property-decorator";

import { BButton } from "bootstrap-vue";

@Component({
  components: {},
})
export default class HeaderComponent extends Vue {}
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

#brand {
  width: 100%;
  margin: auto;
  display: flex;
  justify-content: space-between;
}

/* .phone-only #login-btn {
  position: absolute;
  top: 30px;
  right: 20px;
} */

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

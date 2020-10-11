<template>
  <div id="login2-view">
    <div id="recuperar-text">
      Recupere sua senha:
    </div>
    <div id="recuperar-main">
      <div id="texto-ind">
        Por favor, insira o código enviado para seu numero de telefone.
      </div>
      <div id="input-line">
        <input class="digit-input" type="number" />
        <input class="digit-input" type="number" />
        <input class="digit-input" type="number" />
        <input class="digit-input" type="number" />
        <input class="digit-input" type="number" />
        <input class="digit-input" type="number" />
        <input class="digit-input" type="number" />
        <input class="digit-input" type="number" />
      </div>
      <div id="btn-div">
        <b-button id="prox-btn">Próximo passo</b-button>
      </div>
    </div>
  </div>
</template>

<script>
import { Component, Vue } from "vue-property-decorator";

@Component({})
export default class Login2View extends Vue {}
</script>

<style scoped>
#login2-view {
  width: 100%;
  background-color: #a61731;
}

#recuperar-text {
  padding: 20px;
  color: white;
  font-size: 30px;
  font-weight: bolder;
}

#recuperar-main {
  background-color: white;
  border-top-left-radius: 25px;
  border-top-right-radius: 25px;
  padding: 6vw;
}

#texto-ind {
  font-size: 30px;
}

#input-line {
  margin-top: 70px;
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
}

.digit-input {
  width: 35px;
  height: 45px;
  line-height: 45px;
  font-size: 30px;
  text-align: center;
  border-right: none;
  border-left: none;
  border-top: none;
}

#btn-div {
  width: 100%;
  display: flex;
}

#prox-btn {
  background-color: #f20505;
  font-size: 20px;
  padding: 3vw;
  width: 70%;
  margin: 30px auto;
}
</style>

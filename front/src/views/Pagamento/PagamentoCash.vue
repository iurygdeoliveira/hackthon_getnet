<template>
  <div id="pagamentocash-view">
    <div id="pagamento-title">
      Pagamento em dinheiro:
    </div>
    <div id="pagamento-text">
      Deseja cadastrar pagamento?
    </div>
    <div id="cash">
      <b-input-group prepend="R$">
        <b-input id="input" placeholder="0.00" type="number"></b-input>
      </b-input-group>
      <b-button id="ok-btn">Confirma</b-button>
      <b-button id="cancel-btn">Cancelar pagamento</b-button>
    </div>
  </div>
</template>

<style scoped>
#pagamentocash-view {
  width: 100%;
  font-family: "IBM Plex Sans", sans-serif;
  padding: 8vw;
}

#pagamento-title {
  font-size: 21px;
  font-weight: bold;
  text-align: center;
}

#pagamento-text {
  margin-top: 30px;
  font-size: 16px;
}

#input {
  font-size: 30px;
  line-height: 50px;
  padding: 7vw;
}

#input::placeholder {
  font-size: 30px;
  text-align: left;
}

#cash {
  display: flex;
  flex-direction: column;
  margin-top: 30px;
}

#ok-btn {
  margin: auto;
  margin-top: 20px;
  padding: 2vw 10vw;
  font-size: 20px;
  background-color: #17c261;
  color: white;
}

#cancel-btn {
  font-size: 20px;
  margin: auto;
  margin-top: 100px;
  background-color: #f20505;
  padding: 3vw;
  width: 70%;
}
</style>

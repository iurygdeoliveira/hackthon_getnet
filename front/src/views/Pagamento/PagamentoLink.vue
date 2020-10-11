<template>
  <div id="pagamentolink-view">
    <div id="pagamento-title">
      Pagamento com Link:
    </div>
    <div id="pagamento-text">
      Link de Pagamento criado
    </div>
    <div id="link-cp">
      <b-input
        id="input"
        disabled
        placeholder="https://link.pagamento/jhsgdhsa"
      ></b-input>
      <b-button id="cp-btn">Copiar link</b-button>
      <b-button id="cancel-btn">Cancelar pagamento</b-button>
    </div>
  </div>
</template>

<style scoped>
#pagamentolink-view {
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

#link-cp {
  display: flex;
  flex-direction: column;
  margin-top: 40px;
}

#input {
  color: #7b7a7a;
  background-color: #e5e5e5;
  line-height: 50px;
  padding: 7vw;
}

#input::placeholder {
  text-align: center;
}

#cp-btn {
  margin: auto;
  margin-top: 10px;
  background-color: #f6bc35;
  font-size: 16px;
  width: 40%;
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

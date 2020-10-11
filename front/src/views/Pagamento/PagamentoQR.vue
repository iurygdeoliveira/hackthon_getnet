<template>
  <div id="pagamentoqr-view">
    <div id="padding-group">
      <div id="pagamento-title">
        Pagamento com QR CODE:
      </div>
      <div id="pagamento-text">
        Peça ao seu cliente para escanear o código
      </div>
    </div>
    <div id="qr-img">
      <img src="https://picsum.photos/200?grayscale" alt="" />
      <b-button id="cancel-btn">Cancelar pagamento</b-button>
    </div>
  </div>
</template>

<style scoped>
#pagamentoqr-view {
  width: 100%;
  font-family: "IBM Plex Sans", sans-serif;
}

#padding-group {
  padding: 10vw 8vw;
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

#qr-img {
  width: 100%;
  padding: 6vw;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  background: #f9f2f3 0% 0% no-repeat padding-box;
  border-radius: 25px 25px 0px 0px;
}

#qr-img img {
  margin: auto;
  max-width: min-content;
}

#cancel-btn {
  font-size: 20px;
  margin: auto;
  margin-top: 15px;
  background-color: #f20505;
  padding: 3vw;
  width: 70%;
}
</style>

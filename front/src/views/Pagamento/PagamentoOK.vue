<template>
  <div id="pagamentook-view">
    <div id="pagamento-title">
      Pagamento Concluído!
    </div>
    <div id="success-img">
      <img src="https://picsum.photos/145?grayscale" alt="" />
    </div>
    <b-button class="success-btn">Voltar ao início</b-button>
    <b-button class="success-btn">Ver histórico</b-button>
  </div>
</template>

<style scoped>
#pagamentook-view {
  width: 100%;
  font-family: "IBM Plex Sans", sans-serif;
  padding: 15vw 10vw;
  display: flex;
  flex-direction: column;
}

#success-img {
  max-width: min-content;
  margin: auto;
  margin-top: 50px;
  margin-bottom: 20px;
}

.success-btn {
  margin: auto;
  background-color: #f20505;
  width: 60%;
  padding: 2vw;
  margin-top: 15px;
}

#pagamento-title {
  font-size: 21px;
  font-weight: bold;
  text-align: center;
}
</style>

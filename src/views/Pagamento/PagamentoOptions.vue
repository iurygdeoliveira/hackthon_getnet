<template>
  <div id="pagamento-options">
    <div id="pagamento-text">
      Selecione o tipo de Pagamento:
    </div>
    <div id="metodos">
      <router-link class="met" to="/pagamento/qrcode">
        <img src="https://picsum.photos/100?grayscale" alt="" />
      </router-link>
      <router-link class="met" to="/pagamento/link">
        <img src="https://picsum.photos/100?grayscale" alt="" />
      </router-link>
    </div>
  </div>
</template>

<style scoped>
#pagamento-options {
  font-family: "IBM Plex Sans", sans-serif;
  width: 100%;
  padding: 8vw 4vw;
}

#pagamento-text {
  font-weight: bold;
  text-align: center;
  font-size: 22px;
}

#metodos {
  margin: 30px 0;
  display: flex;
  flex-direction: column;
  justify-content: space-evenly;
}

.met {
  display: inline-block;
  margin: auto;
}

#metodos img {
  margin: 30px auto;
  max-width: max-content;
}
</style>

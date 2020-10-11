<template>
  <div id="cadastro2-view">
    <div id="msg-2">
      Faça sua Inscrição
    </div>
    <div id="etapas" style="margin-top: 10px;">
      <img width="100%" src="https://picsum.photos/200/50?grayscale" alt="" />
    </div>
    <div id="cadastro2-content">
      <strong>Tudo pronto! Em breve entraremos em contato</strong>
      <img src="https://picsum.photos/144?grayscale" alt="" />
      <b-button class="comecar-btn">
        <router-link to="/entrar"> Iniciar Sessão</router-link>
      </b-button>
    </div>
  </div>
</template>

<style scoped>
#msg-2 {
  margin: auto;
  margin-top: 12px;
  padding: 8vw;
  text-align: center;
  color: white;
  background-color: #a61731;
}

#cadastro2-content {
  padding: 8vw 4vw 20vw;
  display: flex;
  flex-direction: column;
}

#cadastro2-content > img {
  margin: auto;
  margin-top: 10px;
  max-width: min-content;
}

.comecar-btn {
  margin: 20px auto auto;
  font-size: 15px;
  width: 130px;
  padding: 5px 1vw;
  background-color: #f20505;
}

.comecar-btn > * {
  font-size: 15px;
  color: white;
}
</style>

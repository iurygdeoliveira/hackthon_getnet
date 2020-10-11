<template>
  <div id="footer-component">
    <div class="list-container">
      <ul class="list">
        <li><a>Home</a></li>
        <li><a>Termos</a></li>
        <li><a>Contato</a></li>
        <li><a>Conta</a></li>
      </ul>
    </div>
    <div class="redes-sociais">
      <div style="color: #888585; font-size: 10px; text-align: center;">
        REDES SOCIAIS
      </div>
      <div id="icons">
        <img
          class="list-icon"
          style="background-color: white;"
          src="../../public/facebook.svg"
          alt=""
        />
        <img class="list-icon" src="../../public/instagram.svg" alt="" />
        <img class="list-icon" src="../../public/youtube.svg" alt="" />
        <img class="list-icon" src="../../public/twitter.svg" alt="" />
      </div>
    </div>
    <div class="sobre">
      <div style="font-size: 10px; color: #888585;">SOBRE:</div>
      <div id="sobre-text">
        A Gestion é uma plataforma de .........criada para facilitar a sua vida
        na gestão de seu negócio ,......... Com ela você .
      </div>
    </div>
  </div>
</template>

<style scoped>
#footer-component {
  background-color: black;
  width: 100%;
  font-family: "IBM Plex Sans", sans-serif;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  padding: 8vw 4vw;
}

#footer-component > * {
  width: 30%;
}

#icons {
  width: 55px;
  margin: auto;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-evenly;
}

.list {
  text-align: center;
  font-size: 10px;
  padding: 0;
  color: #888585;
  /* list-style-image: url("../../public/mitre-join.svg"); */
  list-style: none;
}

.list-icon {
  width: 20px;
}

#sobre-text {
  color: #888585;
  font-size: 8px;
}
</style>

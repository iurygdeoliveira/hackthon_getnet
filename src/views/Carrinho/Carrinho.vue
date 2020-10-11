<template>
  <div id="carrinho-view">
    <div id="title">
      Carrinho:
    </div>
    <!-- Listagem definida esclusivamente pelo Estado global  -->
    <div id="itens-list">
      <div class="item">
        <div id="item-img">
          <img src="https://picsum.photos/30?grayscale" alt="" />
        </div>
        <b-icon icon="caret-right-fill"></b-icon>
        <div id="item-text">
          <div id="item-title"><strong>DADA DADAD</strong></div>
          <div id="item-description">DESLN DADNA DADSA</div>
        </div>
        <div id="price">
          R$ 60,00
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.item {
  display: flex;
}
</style>

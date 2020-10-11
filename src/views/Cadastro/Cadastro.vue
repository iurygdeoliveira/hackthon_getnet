<template>
  <div id="cadastro-view">
    <router-view></router-view>
    <footer-component />
  </div>
</template>

<script>
import { Component, Vue } from "vue-property-decorator";

import FooterComponent from "@/components/Footer.vue";

import { BForm, BFormInput, BButton } from "bootstrap-vue";

@Component({
  components: { "footer-component": FooterComponent },
})
export default class CadastroView extends Vue {
  // created() {
  // }
}
</script>

<style scoped>
#cadastro-view {
  width: 100%;
  font-family: "IBM Plex Sans", sans-serif;
}

#form-cadastro-container {
  width: 100%;
  padding: 8vw 4vw;
}

#msg-2 {
  margin-top: 10px;
  padding: 8vw;
  text-align: center;
  color: white;
  background-color: #a61731;
}

/* .input {
  width: 40%;
} */

.input-container {
  width: 45%;
}

#form-cadastro {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-between;
}

.comecar-btn {
  margin: auto;
  font-size: 15px;
  width: 130px;
  padding: 5px 1vw;
  background-color: #f20505;
  color: white;
}
</style>

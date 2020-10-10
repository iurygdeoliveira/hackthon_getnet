import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";

Vue.config.productionTip = false;

//import do framework do bootstrap-vue
import BootstrapVue from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
Vue.use(BootstrapVue);

import { IconsPlugin, ButtonPlugin, CardPlugin } from "bootstrap-vue";
Vue.use(IconsPlugin);
Vue.use(ButtonPlugin);
Vue.use(CardPlugin);

new Vue({
  router,
  store,
  render: (h) => h(App),
}).$mount("#app");

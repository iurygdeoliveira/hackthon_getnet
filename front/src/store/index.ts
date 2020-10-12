import Vue from 'vue'
import Vuex from 'vuex'

import eventBus from "./eventbus";

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    user: {
      nome: "",
      isLogged: false
    },
    serverURL: "http://64.227.105.196",
    cart: [] as Array<any>,
    cartNext: 0
  },
  mutations: {
    logIn(state, payload: string) {
      state.user.isLogged = true;
      state.user.nome = payload;
      console.log(state.user)
    },
    logOut(state) {
      state.user.isLogged = false;
      state.user.nome = "";
    },
    addItemCart(state, payload) {
      state.cart[state.cartNext] = payload["data"];
      state.cartNext += 1;
    },
    removeItemCart(state, payload) {
      const index = state.cart.findIndex(el => el.id == payload["data"])
      state.cart.splice(index, 1);
      state.cartNext -= 1;
    }
  },
  actions: {
    logIn(context, payload: string) {
      context.commit('logIn', payload);
    },
    logOut(context) {
      context.commit('logOut');
    },
    addItemCart(context, payload) {
      context.commit('addItemCart', payload);
    },
    removeItemCart(context, payload) {
      context.commit("removeItemCart", payload);  
    }
  },
  getters: {
    user(state) {
      return state.user;
    },
    serverURL(state) {
      return state.serverURL;
    },
    getCart(state) {
      return state.cart;
    }
  },
  modules: {
  }
})

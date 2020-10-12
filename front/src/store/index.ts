import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    user: {
      nome: "",
      isLogged: false
    },
    serverURL: "http://64.227.105.196",
    firstLoad: true,
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
    setLoad(state) {
      state.firstLoad = false;
    }
  },
  actions: {
    logIn(context, payload: string) {
      context.commit('logIn', payload);
    },
    logOut(context) {
      context.commit('logOut');
    },
    setLoad(context) {
      context.commit('setLoad');
    }
  },
  getters: {
    user(state) {
      return state.user;
    },
    serverURL(state) {
      return state.serverURL;
    },
    firstLoad(state) {
      return state.firstLoad;
    }
  },
  modules: {
  }
})

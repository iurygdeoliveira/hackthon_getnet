import Vue from "vue";
import VueRouter, { RouteConfig } from "vue-router";
import Home from "../views/Home.vue";

import Cadastro1 from "../views/Cadastro/Cadastro1.vue";
import Cadastro2 from "../views/Cadastro/Cadastro2.vue";

import Login from "../views/Login/Login.vue";
import Login1 from "../views/Login/Login1.vue";
import Login2 from "../views/Login/Login2.vue";

Vue.use(VueRouter);

const routes: Array<RouteConfig> = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/cadastro",
    name: "Cadastro",
    component: () =>
      import(/* webpackChunkName: "cadastro" */ "../views/Cadastro/Cadastro.vue"),
    children: [
      {
        path: "",
        component: Cadastro1
      },
      {
        path: "etapa2",
        component: Cadastro2
      }
    ]
  },
  {
    path: "/entrar",
    component: Login,
    children: [
      {
        path: "",
        component: Login1
      },
      {
        path: "recuperar",
        component: Login2
      }
    ]
  },
  {
    path: "*",
    redirect: "/",
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;

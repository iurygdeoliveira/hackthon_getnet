import Vue from "vue";
import VueRouter, { RouteConfig } from "vue-router";
import Home from "../views/Home.vue";

import Cadastro1 from "../views/Cadastro/Cadastro1.vue";
import Cadastro2 from "../views/Cadastro/Cadastro2.vue";

import Login1 from "../views/Login/Login1.vue";
import Login2 from "../views/Login/Login2.vue";

import PagamentoOptions from "@/views/Pagamento/PagamentoOptions.vue";
import PagamentoQR from "@/views/Pagamento/PagamentoQR.vue";
import PagamentoLink from "@/views/Pagamento/PagamentoLink.vue";
import PagamentoCash from "@/views/Pagamento/PagamentoCash.vue";
import PagamentoOK from "@/views/Pagamento/PagamentoOK.vue";

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
    name: "Login",
    component: () => import(/* webpackChunkName: "login" */ "../views/Login/Login.vue"),
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
    path: "/pagamento",
    name: "Pagamento",
    component: () => import(/* webpackChunkName: "pagamento" */ "../views/Pagamento/Pagamento.vue"),
    children: [
      {
        path: "",
        component: PagamentoOptions,
      },
      {
        path: "qrcode",
        component: PagamentoQR,
      },
      {
        path: "link", 
        component: PagamentoLink
      }, 
      {
        path: "dinheiro",
        component: PagamentoCash
      },
      {
        path: "sucesso",
        component: PagamentoOK
      }
    ]
  },
  {
    path: "/carrinho",
    name: "Carrinho",
    component: () => import(/* webpackChunkName: "carrinho" */ "@/views/Carrinho/Carrinho.vue")
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

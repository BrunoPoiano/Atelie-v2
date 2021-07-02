import { createRouter, createWebHistory } from "vue-router";

import Clientes from "../Pages/ClientesPage/Clientes";
import Servicos from "../Pages/ServicosPage/Servicos.vue";
import Saldo from '../Pages/SaldoPage/Saldo.vue'

const routes = [
    {
        path: "/",
        name: "Clientes",
        component: Clientes,
    },
    {
        path: "/Servicos",
        name: "Servicos",
        component: Servicos,
    },
    {
        path: "/Saldo",
        name: "Saldo",
        component: Saldo,
    },

];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;

import { createRouter, createWebHistory } from "vue-router";

import Clientes from "../Pages/ClientesPage/Clientes";
import Servicos from "../Pages/ServicosPage/Servicos.vue";

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

];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;

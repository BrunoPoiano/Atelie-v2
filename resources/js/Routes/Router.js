import { createRouter, createWebHashHistory } from "vue-router";

import Clientes from "../Pages/ClientesPage/Clientes";
import Servicos from "../Pages/ServicosPage/Servicos.vue";
import Saldo from "../Pages/SaldoPage/Saldo.vue";
import Todo from "../Pages/TodoPage/Todoapp.vue";

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
    {
        path: "/Todo",
        name: "Todo",
        component: Todo,
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;

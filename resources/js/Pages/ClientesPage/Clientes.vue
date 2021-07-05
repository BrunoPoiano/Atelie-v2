<template>
 
    <div class="container text-capitalize">
        <br>
        <div class="row">
            <add-clientes @mensagem="exibirmensagem" />
        </div>
        <br />
        <div class="p-2">
            <input
                type="text"
                class="form-control form-control-lg"
                placeholder="Pesquise um Cliente"
                v-model="cliente"
                @keyup="getClientes"
            />
        </div>
        <br />
        <div v-if="clientes.length">
            <transition-group name="list">

            <div class="" v-for="cli, in clientes" :key="cli.id">
                <clientes-lista :cliente="cli" @mensagem="exibirmensagem" />
            </div>
            </transition-group>

        </div>
        <div v-else>
            <h1>Carregando...</h1>
        </div>
    </div>
</template>

<script>
import AddClientes from "./AddClientes.vue";
import ClientesLista from "./ClientesLista";
import { onMounted, ref } from "vue";
export default {
    components: { AddClientes, ClientesLista },
    setup() {
        const clientes = ref([]);
        const cliente = ref('');
        let fd = new FormData();

        onMounted(() => {
            getClientes();
        });

        const getClientes = () => {
            fd.append("cliente", cliente.value);
            axios
                .post("/clientes/getClientes", fd)
                .then((resp) => {
                    clientes.value = resp.data;
                })
                .catch((err) => console.log(err));
        };
        const exibirmensagem = () => {
            getClientes();
        };

        return { exibirmensagem, clientes, getClientes, cliente };
    },
};
</script>

<style>
/* Transição Clientes*/ 
.list-enter-active,
.list-leave-active {
    transition: all 0.8s ease;
}
.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateY(30px);
}
</style>

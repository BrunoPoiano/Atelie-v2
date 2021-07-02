<template>
    <div class="text-center p-2 text-capitalize">
        <h2>{{ mensagem }}</h2>
    </div>
    <div class="container text-capitalize">
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
            <div class="" v-for="(cli, index) in clientes" :key="index">
                <clientes-lista :cliente="cli" @mensagem="exibirmensagem" />
            </div>
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
        const mensagem = ref();
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
        const exibirmensagem = (mensa) => {
            mensagem.value = mensa;
            getClientes();
        };

        return { exibirmensagem, mensagem, clientes, getClientes, cliente };
    },
};
</script>

<style></style>

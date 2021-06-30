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

        onMounted(() => {
            getClientes();
        });

        const getClientes = () => {
            axios
                .get("/clientes/getClientes")
                .then((resp) => {
                    clientes.value = resp.data;
                })
                .catch((err) => console.log(err));
        };
        const exibirmensagem = (mensa) => {
            mensagem.value = mensa;
            getClientes();
        };

        return { exibirmensagem, mensagem, clientes };
    },
};
</script>

<style></style>

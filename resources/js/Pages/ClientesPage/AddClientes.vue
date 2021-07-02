<template>
    <div class="col-10 text-center">
        <h3>Clientes</h3>
    </div>
    <!-- Button trigger modal -->
    <div class="col">
        <button
            type="button"
            class="btn btn-primary"
            @click="modalAddCliente = true"
        >
            Adicionar Clientes
        </button>
    </div>

    <!-- Modal Add Cliente -->
    <teleport to="body">
        <div
            class="modalcard"
            v-if="modalAddCliente"
            @click.self="modalAddCliente = false"
        >
            <div class="card">
                <div class="col">
                    <h3 class="text-center">Adicionar Clientes</h3>
                    <hr width="100%" align="center" />
                </div>

                <div class="input-group-lg">
                    <label class="form-label">Nome</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="clienteInfo.nome"
                    />
                    <label class="form-label">Telefone</label>
                    <input
                        type="number"
                        class="form-control"
                        v-model="clienteInfo.telefone"
                    />
                    <label class="form-label">Detalhes</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="clienteInfo.detalhes"
                    />
                </div>

                <div class="row p-2">
                    <div class="col pt-1">
                        <button
                            type="button"
                            class="btn btn-warning btn-lg float-end m-1"
                            @click="AddClientes"
                        >
                            Adicionar
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary btn-lg float-end m-1"
                            @click="modalAddCliente = false"
                            href="#top"
                        >
                            fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </teleport>
</template>

<script>
import { ref } from "vue";
export default {
    emits: ["mensagem"],

    setup(props, context) {
        const clienteInfo = ref({ nome: "", telefone: "", detalhes: "" });
        const modalAddCliente = ref(false);

        let fd = new FormData();

        const AddClientes = () => {
            fd.append("nome", clienteInfo.value.nome);
            fd.append("telefone", clienteInfo.value.telefone);
            fd.append("detalhes", clienteInfo.value.detalhes);

            axios
                .post("clientes/store", fd)
                .then((resp) => {
                    modalAddCliente.value = false;
                    context.emit("mensagem", resp.data);
                })
                .catch((err) => console.log(err));
        };

        return {
            clienteInfo,
            AddClientes,
            modalAddCliente,
        };
    },
};
</script>

<style>
.modal {
    font-size: 1.5rem;
}
.modal-header {
    text-align: center;
}
</style>

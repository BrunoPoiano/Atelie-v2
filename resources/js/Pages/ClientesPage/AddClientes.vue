<template>
    <div class="col-10 text-center">
        <h3>Clientes</h3>
    </div>
    <div class="col">
        <!-- Button trigger modal -->
        <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#formcliente"
        >
            Adicionar Clientea
        </button>
    </div>

    <!-- Modal Add Cliente -->
    <div class="modal fade" id="formcliente" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-title pt-3">
                    <h5 class="text-center">Adicionar Clientes</h5>
                    <hr width="100%" align="center" />
                </div>
                <div class="modal-body input-group-lg">
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
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary btn-lg"
                        data-bs-dismiss="modal"
                    >
                        Fechar
                    </button>
                    <button
                        type="button"
                        class="btn btn-primary btn-lg"
                        @click="AddClientes"
                    >
                        Adicionar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
export default {
    emits: ["mensagem"],

    setup(props, context) {
        const clienteInfo = ref({ nome: "", telefone: "", detalhes: "" });
        let fd = new FormData();

        const AddClientes = () => {
            fd.append("nome", clienteInfo.value.nome);
            fd.append("telefone", clienteInfo.value.telefone);
            fd.append("detalhes", clienteInfo.value.detalhes);

            axios
                .post("clientes/store", fd)
                .then((resp) => {
                    context.emit("mensagem", resp.data);
                })
                .catch((err) => console.log(err));
        };

        return {
            clienteInfo,
            AddClientes,
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
}</style>

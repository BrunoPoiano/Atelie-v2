<template>
    <div class="title-clientes" >
        <h1>Clientes</h1>
        <button
            type="button"
            class="btn btn-primary btn-lg"
            @click="modalAddCliente = true"
        >
            Adicionar Clientes
        </button>
    </div>

    <!-- Modal Add Cliente -->
    <teleport to="body">
        <transition name="slide-fade">
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
                        <div v-if="clienteInfo.nome.length == 0">
                            <h5 class="text-danger">
                                Nome não pode ficar vazio
                            </h5>
                        </div>
                        <label class="form-label">Telefone</label>
                        <input
                            type="number"
                            class="form-control"
                            min="0"
                            v-model="clienteInfo.telefone"
                        />
                        <label class="form-label">Detalhes</label>
                        <textarea
                            cols="30"
                            class="form-control"
                            v-model="clienteInfo.detalhes"
                        ></textarea>
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
        </transition>
    </teleport>
</template>

<script>
import { ref } from "vue";
import Swal from "sweetalert2";

export default {
    emits: ["mensagem"],

    setup(props, context) {
        const clienteInfo = ref({ nome: "", telefone: "0", detalhes: "" });
        const modalAddCliente = ref(false);

        let fd = new FormData();

        const AddClientes = () => {
            fd.append("nome", clienteInfo.value.nome);
            fd.append("telefone", clienteInfo.value.telefone);
            fd.append("detalhes", clienteInfo.value.detalhes);

            axios
                .post("api/clientes", fd)
                .then((resp) => {
                    modalAddCliente.value = false;
                    context.emit("mensagem", resp.data);
                    clienteInfo.value.nome = "";
                    clienteInfo.value.telefone = 0;
                    clienteInfo.value.detalhes = "";
                })
                .catch((err) => {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Telefone Deve Ter Apenas Numeros!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                });
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

.title-clientes{
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap:10px;
    flex-wrap: wrap;
}

.modal {
    font-size: 1.5rem;
}
.modal-header {
    text-align: center;
}
.erro {
    border-color: red;
}

/* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>

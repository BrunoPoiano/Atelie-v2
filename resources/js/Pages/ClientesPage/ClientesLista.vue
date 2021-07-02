<template>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="row">
                <div class="col-4 text-left">
                    <div class="fw-bold">
                        <h3>{{ cliente.nome }}</h3>
                    </div>
                    <h4>Tel: {{ cliente.telefone }}</h4>
                </div>
                <div class="col-4 text-center">
                    <h4>{{ cliente.detalhes }}</h4>
                </div>
                <div class="col btn-group-vertical float-end">
                    <button
                        class="btn btn-success"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#criarservico"
                        @click="criarservicoform(cliente)"
                    >
                        Criar Serviço
                    </button>
                    <button
                        class="btn btn-warning"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#editarcliente"
                        @click="criareditarform(cliente)"
                    >
                        Editar
                    </button>
                    <button class="btn btn-danger" @click="apagar(cliente.id)">
                        Apagar
                    </button>
                </div>
            </div>
        </li>
    </ul>

    <!-- Modal editar Cliente -->
    <div class="modal fade"  id="editarcliente" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-title pt-3">
                    <h5 class="text-center">Editar Clientes</h5>
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
                        @click="editarcliente"
                    >
                        Editar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Criar servico -->
    <div class="modal fade" id="criarservico" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-title pt-3">
                    <h5 class="text-center">Criar Servico</h5>
                    <hr width="100%" align="center" />
                </div>

                <div class="modal-body input-group-lg">
                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="servico.cliente"
                            disabled
                        />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Data Inicial</label>
                        <datepicker
                            class="form-control form-control-lg"
                            v-model="data"
                            :inputFormat="'dd/MM/yyyy'"
                        />
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">Preço</label>
                                <input
                                    type="number"
                                    min="0"
                                    v-model="servico.preco"
                                    class="form-control"
                                />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Pago</label>

                                <select
                                    class="form-select"
                                    aria-label="Default select example"
                                    v-model="servico.pago"
                                >
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">servico</label>
                        <textarea
                            class="form-control"
                            v-model="servico.servico"
                            rows="3"
                        ></textarea>
                    </div>
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
                        @click="criarservico"
                    >
                        Editar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import Datepicker from "vue3-datepicker";

export default {
    props: ["cliente"],
    emits: ["mensagem"],
    components: { Datepicker },

    setup(props, context) {
        const clienteInfo = ref({ nome: "", telefone: "", detalhes: "" });
        const servico = ref({
            pago: "0",
            preco: "0",
            servico: "",
            cliente: "",
        });
        const data = ref(new Date());

        let editatservicofd = new FormData();
        let servicofd = new FormData();

        const criareditarform = (cliente) => {
            clienteInfo.value.id = cliente.id;
            clienteInfo.value.nome = cliente.nome;
            clienteInfo.value.telefone = cliente.telefone;
            clienteInfo.value.detalhes = cliente.detalhes;
        };

        const editarcliente = () => {
            editatservicofd.append("nome", clienteInfo.value.nome);
            editatservicofd.append("telefone", clienteInfo.value.telefone);
            editatservicofd.append("detalhes", clienteInfo.value.detalhes);

            /*
            axios
                .post(
                    "clientes/editar/" + clienteInfo.value.id,
                    editatservicofd
                )
                .then((resp) => {
                    context.emit("mensagem", resp.data);
                })
                .catch((err) => {
                    if (err.response.status == 422) {
                        context.emit("mensagem", "Nome não pode ser vazio");
                    }
                });
                */
        };

        const apagar = (id) => {
            axios
                .delete("clientes/apagar/" + id)
                .then((resp) => {
                    context.emit("mensagem", resp.data);
                })
                .catch((err) => console.log(err));
        };

        const criarservicoform = (cliente) => {
            servico.value.cliente = cliente.nome;
            servico.value.id = cliente.id;
        };

        const criarservico = () => {
            let datetime = new Date(data.value);
            servicofd.append("pago", servico.value.pago);
            servicofd.append("valor", servico.value.preco);
            servicofd.append("data", datetime.toISOString());
            servicofd.append("servico", servico.value.servico);
            servicofd.append("cliente_id", servico.value.id);

            servicofd.forEach((el) => {
                console.log(el);
            });

            axios
                .post("servicos/store", servicofd)
                .then((resp) => {
                    context.emit("mensagem", resp.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        };

        return {
            criareditarform,
            editarcliente,
            apagar,
            clienteInfo,
            criarservicoform,
            servico,
            data,
            criarservico,
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

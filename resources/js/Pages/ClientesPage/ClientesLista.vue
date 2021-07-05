<template>
    <!-- Lista de Clientes-->
    <ul class="list-group list-group-flush root">
        <li class="list-group-item">
            <div class="row">
                <div class="col-4 text-left">
                    <div class="fw-bold">
                        <h3>{{ cliente.nome }}</h3>
                    </div>
                    <h4>Tel: {{ cliente.telefone }}</h4>
                </div>
                <div
                    class="col-4 text-center text-centralized"
                    style="
                        word-wrap: break-word;
                        min-width: 160px;
                        max-width: 160px;
                    "
                >
                    <h4>{{ cliente.detalhes }}</h4>
                </div>
                <div class="col align-self-center">
                    <button
                        class="btn btn-success p-3 float-end"
                        type="button"
                        @click="criarservicoform(cliente)"
                    >
                        Criar Serviço
                    </button>
                </div>

                <div class="col">
                    <div class="row float-end align-self-center">
                        <button
                            class="btn btn-warning"
                            type="button"
                            @click="criareditarform(cliente)"
                        >
                            Editar
                        </button>

                        <button
                            class="btn btn-danger"
                            @click="apagar(cliente.id)"
                        >
                            Apagar
                        </button>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <!-- Modal Criar servico -->
    <teleport to="body">
        <transition name="slide-fade">
            <div
                class="modalcard"
                v-if="modalCriarServico"
                @click.self="modalCriarServico = false"
            >
                <div class="card">
                    <div class="col">
                        <h3 class="text-center">Criar Servico</h3>
                        <hr width="100%" align="center" />
                    </div>

                    <div class="input-group-lg">
                        <label class="form-label">Cliente</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="servico.cliente"
                            disabled
                        />
                        <label for="" class="form-label">Data</label>
                        <datepicker
                            class="form-control form-control-lg"
                            v-model="data"
                            :inputFormat="'dd/MM/yyyy'"
                        />
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
                        <div class="col">
                            <label class="form-label">servico</label>
                            <textarea
                                class="form-control"
                                v-model="servico.servico"
                                rows="3"
                            ></textarea>
                        </div>

                        <div class="row p-2">
                            <div class="col pt-1">
                                <button
                                    type="button"
                                    class="btn btn-success btn-lg float-end m-1"
                                    @click="criarservico"
                                >
                                    Criar
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-primary btn-lg float-end m-1"
                                    @click="modalCriarServico = false"
                                    href="#top"
                                >
                                    fechar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </teleport>

    <!-- Modal editar Cliente -->
    <teleport to="body">
        <transition name="slide-fade">
            <div
                class="modalcard"
                v-if="modalEditar"
                @click.self="modalEditar = false"
            >
                <div class="card">
                    <div class="col">
                        <h3 class="text-center">Editar Clientes</h3>
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
                                @click="editarcliente"
                            >
                                Editar
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary btn-lg float-end m-1"
                                @click="modalEditar = false"
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
import Datepicker from "vue3-datepicker";
import Swal from "sweetalert2";
export default {
    props: ["cliente"],
    emits: ["mensagem"],
    components: { Datepicker, Swal },

    setup(props, context) {
        const clienteInfo = ref({ nome: "", telefone: "", detalhes: "" });
        const servico = ref({
            pago: "0",
            preco: "0",
            servico: "",
            cliente: "",
        });
        const data = ref(new Date());

        const modalEditar = ref(false);
        const modalCriarServico = ref(false);

        let editatservicofd = new FormData();
        let servicofd = new FormData();

        const criareditarform = (cliente) => {
            modalEditar.value = true;
            clienteInfo.value.id = cliente.id;
            clienteInfo.value.nome = cliente.nome;
            clienteInfo.value.telefone = cliente.telefone;
            clienteInfo.value.detalhes = cliente.detalhes;
        };

        const editarcliente = () => {
            editatservicofd.append("nome", clienteInfo.value.nome);
            editatservicofd.append("telefone", clienteInfo.value.telefone);
            editatservicofd.append("detalhes", clienteInfo.value.detalhes);

            axios
                .post(
                    "clientes/editar/" + clienteInfo.value.id,
                    editatservicofd
                )
                .then((resp) => {
                    if (resp.status == 200) {
                        Swal.fire({
                            icon: "success",
                            position: "top-end",
                            title: resp.data,
                            showConfirmButton: false,
                            timer: 1000,
                        });
                        context.emit("mensagem");
                    }

                    modalEditar.value = false;
                })
                .catch((err) => {
                    if (err.response.status == 422) {
                        context.emit("mensagem");
                    }
                });
        };

        const apagar = (id) => {
            Swal.fire({
                title: "Tem Certeza?",
                text: "Deseja apagar Cliente?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sim, Apagar!",
                cancelButtonText: "Não",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete("clientes/apagar/" + id)
                        .then((resp) => {
                            if (resp.status == 200) {
                                Swal.fire({
                                    icon: "success",
                                    position: "top-end",
                                    title: resp.data,
                                    showConfirmButton: false,
                                    timer: 1000,
                                });
                            }
                            context.emit("mensagem");
                        })
                        .catch((err) => console.log(err));
                }
            });
        };

        const criarservicoform = (cliente) => {
            modalCriarServico.value = true;

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
                    if ((resp.status = 200)) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Servico Criado Com Sucesso!",
                            showConfirmButton: false,
                            timer: 1000,
                        });
                        modalCriarServico.value = false;
                        context.emit("mensagem");
                    }
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
            modalEditar,
            modalCriarServico,
        };
    },
};
</script>

<style>
body {
    position: relative;
}
.modalcard {
    position: fixed;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 56%);
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    scroll-behavior: smooth(0, 0);
}
.modalcard > div {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    width: 40rem;
    font-size: 1.5rem;
}

/* Transição modal*/ 
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

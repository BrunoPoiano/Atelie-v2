<template>
    <div class="col-sm-12 col-md-6 col-lg-4 p-2 text-capitalize">
        <div
            :class="[
                servicos.pago == 0 ? 'border-danger' : 'border-success',
                'card',
            ]"
        >
            <div
                :class="[
                    servicos.pago == 0 ? 'bg-danger' : 'bg-success',
                    'card-header card text-white  mb-3',
                ]"
            >
                <div class="col text-center p-2">
                    <h2>{{ servicos.nome }}</h2>
                </div>
            </div>
            <div class="card-body">
                <div class="col p-2 text-center">
                    <h3>{{ servicos.time }}</h3>
                </div>
                <div class="row p-1">
                    <div class="col-6">
                        <h3>R$: {{ servicos.valor }}</h3>
                    </div>
                    <div class="col-6">
                        <h3>Pago: {{ servicos.pagoexib }}</h3>
                    </div>
                </div>
                <div class="col p-2">
                    <p>{{ servicos.servico }}</p>
                </div>
            </div>
            <div class="card-footer">
                <div class="row p-2">
                    <div class="col-6 text-center">
                        <button
                            class="btn btn-warning btn-lg"
                            @click="criarEditarServicoForm(servicos)"
                        >
                            Editar
                        </button>
                    </div>
                    <div class="col-6 text-center">
                        <button class="btn btn-danger btn-lg"
                        @click="apagarServico(servicos.id)"
                        >Excluir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar servico -->
    <teleport to="body">
        <div
            class="modalcard"
            v-if="modalEditarServico"
            @click.self="modalEditarServico = false"
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
                                class="btn btn-warning btn-lg float-end m-1"
                                @click="editarServico"
                            >
                                Editar
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary btn-lg float-end m-1"
                                @click="modalEditarServico = false"
                                href="#top"
                            >
                                fechar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </teleport>
</template>

<script>
import { onMounted, ref } from "@vue/runtime-core";
import Datepicker from "vue3-datepicker";

export default {
    props: ["servicos"],
    components: { Datepicker },
    setup(props, context) {
        const modalEditarServico = ref(false);
        const servico = ref({ cliente: "", servico: "", preco: "", pago: "" });
        const data = ref();

        let fd = new FormData();

        function datahandle(data) {
            let date = new Date(data);
            let dia = date.getDate();
            let mes = date.getMonth();
            let ano = date.getFullYear();
            mes = mes + 1;
            if (mes < 10) {
                mes = "0" + mes;
            }
            if (dia < 10) {
                dia = "0" + dia;
            }
            return ano + "-" + mes + "-" + dia + " 12:00:00";
        }

        const criarEditarServicoForm = (serv) => {
            console.log(serv);
            modalEditarServico.value = true;
            servico.value.id = serv.id;
            servico.value.cliente = serv.nome;
            servico.value.cliente_id = serv.cliente_id;
            servico.value.servico = serv.servico;
            servico.value.preco = serv.valor;
            servico.value.pago = serv.pago;
            data.value = new Date(serv.data);
        };

        const editarServico = () => {
            console.log(servico.value);

            let dt = datahandle(data.value);

            fd.append("servico", servico.value.servico);
            fd.append("preco", servico.value.preco);
            fd.append("data", dt);
            fd.append("pago", servico.value.pago);

            axios
                .post("/servicos/update/" + servico.value.id, fd)
                .then((resp) => {
                    modalEditarServico.value = false;
                    context.emit("mensagem", resp.data);
                    console.log(resp.data);
                });
        };

        const apagarServico =(id)=>{
            axios.delete('/servicos/destroy/'+id)
            .then(resp =>{
                context.emit('mensagem', resp.data)
                console.log(resp)
            })
        }

        return {
            servico,
            modalEditarServico,
            criarEditarServicoForm,
            editarServico,
            data,
            apagarServico,
        };
    },
};
</script>

<style>
div.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
p {
    font-size: 1.5rem;
}
</style>

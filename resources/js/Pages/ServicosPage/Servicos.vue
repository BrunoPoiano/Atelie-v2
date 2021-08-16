<template>
    <div class="container">
        <br />
        <div class="col text-center pb-2">
            <h1>Serviços</h1>
        </div>
        <div class="p-2">
            <div class="row">
                <div class="col-6">
                    <h4 for="" class="form-label">Data Inicial</h4>
                    <datepicker
                        class="form-control form-control-lg"
                        v-model="datainicial"
                        :inputFormat="'dd/MM/yyyy'"
                        style="background-color: white;"
                    />
                </div>
                <div class="col-6">
                    <h4 for="" class="form-label">Data Final</h4>
                    <datepicker
                        class="form-control form-control-lg"
                        v-model="datafinal"
                        :inputFormat="'dd/MM/yyyy'"
                        style="background-color: white;"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <h4 class="form-label">Pago</h4>

                    <select
                        class="form-control form-control-lg"
                        aria-label="Default select example"
                        v-model="getServicos.pago"
                        @change="getservico"
                    >
                        <option :value="null">Todos</option>
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>
                <div class="col-6">
                    <h4 class="form-label">Nome do Cliente</h4>
                    <input
                        type="text"
                        class="form-control form-control-lg"
                        v-model="getServicos.cliente"
                        @keyup="getservico"
                    />
                </div>
            </div>
        </div>
        <div class="col p-2">
            <button class="btn btn-success btn-lg" @click="getservico">
                Pesquisar
            </button>
        </div>
        <div class="row">
            <transition-group name="list">
                <div
                    class="col-sm-12 col-md-6 col-lg-4 p-2 text-capitalize"
                    v-for="ser in servicos"
                    :key="ser.id"
                >
                    <servicos-card :servicos="ser" @mensagem="exibirmensagem" />
                </div>
            </transition-group>
        </div>
        <br />
    </div>
</template>

<script>
import { ref } from "vue";
import { onMounted } from "@vue/runtime-core";
import ServicosCard from "./ServicosCard.vue";

import Datepicker from "vue3-datepicker";
import moment from "moment";

export default {
    components: { ServicosCard, Datepicker },
    setup() {
        const servicos = ref([]);
        const datainicial = ref(new Date());
        const datafinal = ref(new Date());
        const getServicos = ref({
            pago: "null",
            cliente: "",
        });

        onMounted(() => {
            getservico();
        });

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
            return ano + "-" + mes + "-" + dia;
        }

        const getservico = () => {
            let dtinicial = datahandle(datainicial.value);
            let dtfinal = datahandle(datafinal.value);

            let fdservicos = new FormData();
            fdservicos.append("datainicial", dtinicial);
            fdservicos.append("datafinal", dtfinal);
            fdservicos.append("pago", getServicos.value.pago);
            fdservicos.append("cliente", getServicos.value.cliente);

            axios.post("api/servicos/getServico", fdservicos).then((resp) => {
                servicos.value = resp.data;
                console.log(resp)
                servicos.value.forEach((el) => {
                    if (el.servico == "null") {
                        el.servico = "-";
                    }
                    el.valorFinal = parseInt(el.valor) + parseInt(el.gastos)
                    console.log('el.valorFinal ', el.valorFinal)
                });

                servicos.value.forEach((el) => {
                    moment.locale("pt-br");
                    el.time = moment(el.data).format("Do MMMM - YYYY ");
                    if (el.pago == 0) {
                        el.pagoexib = "Não";
                    } else {
                        el.pagoexib = "Sim";
                    }
                });
            });
        };

        const exibirmensagem = () => {
            getservico();
        };

        return {
            servicos,
            getServicos,
            getservico,
            datainicial,
            datafinal,
            exibirmensagem,
        };
    },
};

</script>

<style>
/* Transição Servicos*/ 
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

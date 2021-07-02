<template>
    <div class="text-center p-2 text-capitalize">
        <h2>{{ mensagem }}</h2>
    </div>
    <div class="p-2">
        <div class="col text-center p-2">
            <h2>Serviços</h2>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="" class="form-label">Data Inicial</label>
                <datepicker
                    class="form-control form-control-lg"
                    v-model="datainicial"
                    :inputFormat="'dd/MM/yyyy'"
                />
            </div>
            <div class="col-6">
                <label for="" class="form-label">Data Final</label>
                <datepicker
                    class="form-control form-control-lg"
                    v-model="datafinal"
                    :inputFormat="'dd/MM/yyyy'"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label class="form-label">Pago</label>

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
                <label class="form-label">Nome do Cliente</label>
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
        <servicos-card
            :servicos="ser"
            v-for="(ser, index) in servicos"
            :key="index"
            @mensagem="exibirmensagem"
        />
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
        const mensagem = ref();
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

            axios.post("servicos/getServico", fdservicos).then((resp) => {
                servicos.value = resp.data;

                servicos.value.forEach((el) => {
                    moment.locale("pt-br");
                    el.time = moment(el.data).format("Do MMMM - YYYY ");
                    if (el.pago == 0) {
                        el.pagoexib = "Não";
                    } else {
                        el.pagoexib = "Sim";
                    }
                });

                console.log(servicos.value);
            });
        };

        const exibirmensagem = (mens) => {
            mensagem.value = mens;
            getservico();
        };

        return {
            servicos,
            getServicos,
            getservico,
            datainicial,
            datafinal,
            exibirmensagem,
            mensagem,
        };
    },
};
</script>

<style></style>

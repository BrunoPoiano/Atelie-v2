<template>
    <div class="p-2">
        <div class="col text-center p-2">
            <h2>Serviços</h2>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="" class="form-label">Data Inicial</label>
                <datepicker
                    class="form-control form-control-lg"
                    v-model="getServicos.dataincial"
                    :inputFormat="'dd/MM/yyyy'"
                />
            </div>
            <div class="col-6">
                <label for="" class="form-label">Data Final</label>
                <datepicker
                    class="form-control form-control-lg"
                    v-model="getServicos.datafinal"
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
                >
                    <option>Todos</option>
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
                />
            </div>
        </div>
    </div>

    <div class="row">
        <servicos-card
            :servicos="ser"
            v-for="(ser, index) in servicos"
            :key="index"
        />
    </div>
</template>

<script>
import { ref } from "vue";
import { onMounted } from "@vue/runtime-core";
import ServicosCard from "./ServicosCard.vue";

import Datepicker from "vue3-datepicker";

export default {
    components: { ServicosCard, Datepicker },
    setup() {
        const servicos = ref([]);
        const getServicos = ref({
            dataincial: new Date(),
            datafinal: new Date(),
            pago: "",
            cliente: "",
        });

        onMounted(() => {
            getservicos();
        });

        const getservicos = () => {
            axios.get("servicos/getServico").then((resp) => {
                servicos.value = resp.data;
            });
        };

        return { servicos, getServicos };
    },
};
</script>

<style></style>

<template>
    <div class="container">
        <br />
        <div class="col-lg-10 col-md-6 text-center">
            <h1>Saldo</h1>
        </div>
        <div class="row">
            <div class="col input-group-lg align-self-center">
                <h4 class="form-label">Ano Desejado</h4>
                <input
                    type="number"
                    min="2010"
                    v-model="ano"
                    class="form-control"
                    @change="testar"
                />
            </div>
            <div class="col-3 align-self-center">
                <div class="row">
                    <h3 class="text-center fw-bold">{{ ano }}</h3>

                    <div class="col p-0">
                        <div class="card text-success text-center">
                            <span>Positivo </span>
                            <h4>R$: {{ total.positivo }}</h4>
                        </div>
                    </div>
                    <div class="col p-0">
                        <div class="card text-danger text-center">
                            <span>Negativo </span>
                            <h4>R$: {{ total.negativo }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row p-3 boxshadowsaldo">
            <div
                class="card col-3"
                v-for="(sld, index) in saldomensal"
                :key="index"
            >
                <h4 class="text-center fw-bold">{{ sld.mes }}</h4>
                <h4 class="text-success">R$: {{ sld.recebido }}</h4>
                <h4 class="text-danger">R$: {{ sld.devendo }}</h4>
            </div>
        </div>
        <br />
    </div>
</template>

<script>
import { onMounted, ref } from "vue";
export default {
    components: {},
    setup() {
        const ano = ref();
        const saldomensal = ref([]);
        const total = ref({ positivo: 0, negativo: 0 });

        onMounted(() => {
            let dt = new Date();
            ano.value = dt.getFullYear();
            testar();
        });

        const testar = () => {
            let fd = new FormData();
            fd.append("ano", ano.value);

            axios.post("saldo/saldo", fd).then((resp) => {
                saldomensal.value = resp.data.mensal;
                total.value.positivo = resp.data.anual.positivo;
                total.value.negativo = resp.data.anual.negativo;
            });
        };

        return {
            ano,
            testar,
            saldomensal,
            total,
        };
    },
};
</script>

<style>

.boxshadowsaldo {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.212),
        0 6px 20px 0 rgba(0, 0, 0, 0.521);
}</style>

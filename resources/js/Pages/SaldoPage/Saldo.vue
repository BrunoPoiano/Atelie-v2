<template>
    <div class="container">
        <br />
        <div class="col text-center">
            <h1>Saldo</h1>
        </div>
        <div class="">
            <div class="">
                <h4 class="form-label">Ano Desejado</h4>
                <input
                    type="number"
                    min="2010"
                    v-model="ano"
                    class="form-control"
                    @change="getano"
                />
            </div>
            <div class="">
                <div class="row">
                    <div class="col-6">
                        <h3 class="text.dark text-center fw-bold">Hoje</h3>
                        <div class="card">
                            <div class="card text-dark text-center">
                                <h4 class="hoje">R$: {{ hoje }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <h3 class="text.dark text-center fw-bold">
                                {{ ano }}
                            </h3>

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
            </div>
        </div>
        <br />
        <div class="row p-3 boxshadowsaldo">
            <div
                class="card col-lg-3 col-md-6  col-sm-12"
                v-for="(sld, index) in saldomensal"
                :key="index"
            >
                <h4 class="text-center fw-bold">
                    {{ sld.mes }}
                </h4>
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
        const hoje = ref();
        const saldomensal = ref([]);
        const total = ref({ positivo: 0, negativo: 0 });

        onMounted(() => {
            let dt = new Date();
            ano.value = dt.getFullYear();
            getano();
        });

        const getano = () => {
            let fd = new FormData();
            fd.append("ano", ano.value);

            axios.post("api/saldo", fd).then((resp) => {
                saldomensal.value = resp.data.mensal;
                total.value.positivo = resp.data.anual.positivo;
                total.value.negativo = resp.data.anual.negativo;
                hoje.value = resp.data.hoje;
            });
        };

        return {
            ano,
            hoje,
            getano,
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
}
.hoje{
    padding: 0.7rem;
}
</style>

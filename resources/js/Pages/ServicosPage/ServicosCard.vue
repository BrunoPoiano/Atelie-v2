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
                        <button class="btn btn-warning btn-lg">Editar</button>
                    </div>
                    <div class="col-6 text-center">
                        <button class="btn btn-danger btn-lg">Excluir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted } from "@vue/runtime-core";
export default {
    props: ["servicos"],
    setup(props, context) {
      
    },
};
</script>

<style>
div.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
p{
    font-size: 1.5rem;
}
</style>

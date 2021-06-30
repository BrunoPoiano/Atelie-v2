<template>
    <div class="col-sm-6 p-2">
        <div
            :class="[
                servicos.pago == 'Não' ? 'border-danger' : 'border-success',
                'card',
            ]"
        >
            <div
                :class="[
                    servicos.pago == 'Não' ? 'bg-danger' : 'bg-success',
                    'card-header card text-white  mb-3',
                ]"
            >
                <div class="col text-center p-2">
                    <h2>{{ servicos.nome }}</h2>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h3>R$: {{ servicos.valor }}</h3>
                    </div>
                    <div class="col-6">
                        <h3>Pago: {{ servicos.pago }}</h3>
                    </div>
                </div>
                <div class="col">
                    <h4> {{ servicos.servico }}</h4>
                   
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
        onMounted(() => {
            if (props.servicos.pago == false) {
                props.servicos.pago = "Não";
            } else {
                props.servicos.pago = "Sim";
            }
        });
    },
};
</script>

<style>
div.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>

<template>
    <div class="p-2">
        <div class="row">
            <div class="col-6">
                <input
                    type="text"
                    class="form-control form-control-lg"
                    placeholder="Data Inicial"
                />
            </div>
            <div class="col-6">
                <input
                    type="text"
                    class="form-control form-control-lg"
                    placeholder="Data Final"
                />
            </div> 
        </div>
        <div class="row">
            <div class="col-6">
                <input
                    type="text"
                    class="form-control form-control-lg"
                    placeholder="Pago"
                />
            </div>
            <div class="col-6">
                <input
                    type="text"
                    class="form-control form-control-lg"
                    placeholder="Nome do Cliente"
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
export default {
    components: { ServicosCard },
    setup() {
        const servicos = ref([]);
        onMounted(() => {
            getservicos();
        });


        const getservicos = () => {
            axios.get("servicos/getServico").then((resp) => {
                servicos.value = resp.data;
            });
        };

        return { servicos };
    },
};
</script>

<style></style>

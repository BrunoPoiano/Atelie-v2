<template>
    <div class="container">
        <br />
        <div class="row">
            <div class="col">
                <input
                    type="number"
                    min="2010"
                    v-model="ano"
                    class="form-control"
                    @change="testar"
                />
            </div>
        </div>
        <div class="row p-2">
    
                <div
                    class="card col-3"
                    v-for="(sld, index) in saldo" 
                    :key="index"
                >
                    <label>{{ sld.mes }}</label>
                    <h4 class="text-success">{{ sld.recebido }}</h4>
                    <h4 class="text-danger">{{ sld.devendo }}</h4>
                </div>
        </div>
    </div>
</template>

<script>
import { onMounted, ref } from "vue";
export default {
    components: {},
    setup() {
        const ano = ref();
        const saldo = ref([]);

        onMounted(() => {
            let dt = new Date();
            ano.value = dt.getFullYear();
            testar();
        });

        const testar = () => {
            let fd = new FormData();
            fd.append("ano", ano.value);

            axios.post("saldo/saldo", fd).then((resp) => {
                saldo.value = resp.data;
            });
        };

        return {
            ano,
            testar,
            saldo,
        };
    },
};
</script>

<style></style>

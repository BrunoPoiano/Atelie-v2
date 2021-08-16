<template>
    <div class="container">
        <br />
        <div class="col text-center pb-2">
            <h1>Afazeres</h1>
        </div>
        <!-- Criar Afazer-->
        <div class="card card-body">
            <div class="row">
                <h3 class="text-center">Prioridade</h3>
                <div class="col" v-for="(p, index) in prioridade" :key="index">
                    <div class="form-check col-4">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            :value="p.id"
                            v-model="pid"
                            required
                        />
                        <label class="form-check-label" for="flexRadioDefault1">
                            <h3>{{ p.nome }}</h3>
                        </label>
                    </div>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-lg-10 col-sm-12">
                    <input
                        type="text"
                        class="form-control form-control-lg"
                        placeholder="Afazer"
                        v-model="afazer"
                        @keyup.enter="store"
                    />
                </div>
                <div class="col-lg-2 col-sm-12">
                    <button class="btn btn-success btn-lg" @click="store">
                        OK
                    </button>
                </div>
            </div>
        </div>

        <!-- Exibir afazeres-->
        <h3 class="text-center">Afazeres</h3>
        <transition-group name="list">
            <div
                class="card card-body"
                v-for="af in afazeres"
                :key="af.id"
                :class="
                    af.prioridade == 1
                        ? 'text-danger'
                        : '' || af.prioridade == 2
                        ? 'text-warning'
                        : '' || af.prioridade == 3
                        ? 'text-primary'
                        : ''
                "
            >
                <div class="row">
                    <div class="col-9">
                        <h4>{{ af.afazer }} - {{ af.nome }}</h4>
                    </div>
                    <div class="col-3">
                        <button
                            class="btn btn-success"
                            @click="concluido(af.id)"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-check-lg"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"
                                />
                            </svg>
                        </button>
                        <button class="btn btn-danger" @click="Apagar(af.id)">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-trash-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </transition-group>

        <hr width="”25%”" align="”right”" />
        <h3 class="text-center">Concluidas</h3>

        <!-- Exibir afazeres finalizados-->
        <transition-group name="list">
            <div
                class="card card-body text-secondary"
                v-for="af in afazeresfinalizados"
                :key="af.id"
            >
                <div class="row">
                    <div class="col-9">
                        <h4>{{ af.afazer }}</h4>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-danger" @click="Apagar(af.id)">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-trash-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </transition-group>
        <br />
    </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import { onMounted } from "@vue/runtime-core";
import Swal from "sweetalert2";

export default {
    components: { Swal },

    setup() {
        const afazer = ref();
        const afazeres = ref([]);
        const afazeresfinalizados = ref([]);
        const prioridade = ref([]);
        const pid = ref(3);
        let fd = new FormData();

        onMounted(() => {
            getPrioridade();
            getafazeres();
            getafazeresfinalizados();
        });

        const getPrioridade = () => {
            axios
                .get("api/getprioridades")
                .then((resp) => {
                    prioridade.value = resp.data;
                    console.log(resp.data);
                })
                .catch(
                    (err) => (mensagem.value = "Erro ao exibir prioridades")
                );
        };

        const getafazeres = () => {
            axios.get("api/getafazeres").then((resp) => {
                afazeres.value = resp.data;
            });
        };

        const getafazeresfinalizados = () => {
            axios.get("api/getafazeresfinalizados").then((resp) => {
                afazeresfinalizados.value = resp.data;
            });
        };

        const store = () => {
            if (pid.value == undefined) {
                Swal.fire({
                    icon: "warning",
                    position: "top-end",
                    title: "Escolha uma prioridade",
                    showConfirmButton: false,
                    timer: 1000,
                });
            } else if (afazer.value == undefined || afazer.value == "") {
                Swal.fire({
                    icon: "warning",
                    position: "top-end",
                    title: "Digite um Afazer",
                    showConfirmButton: false,
                    timer: 1000,
                });
            } else {
                fd.append("prioridade", pid.value);
                fd.append("afazer", afazer.value);

                axios
                    .post("api/todo", fd)
                    .then((resp) => {
                        Swal.fire({
                            icon: "success",
                            position: "top-end",
                            title: resp.data,
                            showConfirmButton: false,
                            timer: 1000,
                        });
                        afazer.value = "";
                        getafazeres();
                        getafazeresfinalizados();
                    })
                    .catch((error) => {
                        Swal.fire({
                            icon: "success",
                            position: "top-end",
                            title: "erro ao salvar",
                            showConfirmButton: false,
                            timer: 1000,
                        });
                    });
            }
        };

        const concluido = (id) => {
            axios.put("api/todo/" + id).then((resp) => {
                if (resp.status == 200) {
                    Swal.fire({
                        icon: "success",
                        position: "top-end",
                        title: "Afazer Finalizado!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    getafazeres();
                    getafazeresfinalizados();
                } else {
                    Swal.fire({
                        icon: "success",
                        position: "top-end",
                        title: "Erro ao concluir afazer!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                }
            });
        };

        const Apagar = (id) => {
            axios.delete("api/todo/" + id).then((resp) => {
                if (resp.status == 200) {
                    getafazeres();
                    getafazeresfinalizados();
                    Swal.fire({
                        icon: "success",
                        position: "top-end",
                        title: "Afazer Deletado com Sucesso!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                } else {
                    Swal.fire({
                        icon: "success",
                        position: "top-end",
                        title: "Erro ao deletar afazer!",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                }
            });
        };

        return {
            store,
            afazer,
            prioridade,
            pid,
            afazeres,
            concluido,
            Apagar,
            afazeresfinalizados,
        };
    },
};
</script>

<style scoped>

/* Transição Afazeres*/
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

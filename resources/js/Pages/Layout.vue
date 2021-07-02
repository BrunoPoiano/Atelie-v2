<template>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <h2 class="navbar-text">Sistema Atelie</h2>
        </div>
    </nav>
    <div class="p-2">
        <div class="row m-0">
            <div class="col-lg-2 col-md-3 btn-group-vertical size">
                <router-link
                    :to="{ name: 'Clientes' }"
                    class="btn btn-outline-success btn-lg"
                    >Clientes</router-link
                >
                <router-link
                    :to="{ name: 'Servicos' }"
                    class="btn btn-outline-success btn-lg"
                    >Servicos</router-link
                >
                <router-link
                    :to="{ name: 'Saldo' }"
                    class="btn btn-outline-success btn-lg"
                    >Saldo</router-link
                >
            </div>
            <div class="col boxshadow">
                <router-view />
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style scoped>
.size {
    margin-top: 5rem;
    height: 5rem;
}

.boxshadow {
    margin-top: 1rem;
    background: white;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>

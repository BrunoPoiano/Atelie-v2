<template>
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <h3 class="navbar-text ml-2">Dona Nalva V2</h3>
    </div>
  </nav>

  <div class="atelie-layout">
    <div class="atelie-layout-menu">
      <router-link
        :to="{ name: 'Todo' }"
        class="btn btn-outline-success btn-lg afazer"
        >Afazeres</router-link
      >
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
    <div class="atelie-layout-content">
      <router-view v-slot="{ Component }">
        <transition name="fade" mode="out-in">
          <component :is="Component" />
        </transition>
      </router-view>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style  scoped>
.atelie-layout {
  display: flex;
  gap: 10px;
  margin-top: 100px;
  padding: 10px 20px;
  align-items: flex-start;
}

.atelie-layout-menu {
  width: 150px;
  flex-grow: 1;

  display: flex;
  gap: 5px;
  flex-direction: column;
  flex-wrap: wrap;

  top: 100px;
  position: sticky;
}

.atelie-layout-menu > a {
  width: 100%;
}

.atelie-layout-content {
  flex-grow: 99;
  width: 100%;
}


@media (width < 700px) {
    .atelie-layout {
        flex-direction: column;
      }

      .atelie-layout-menu {
        flex-direction: row;
        justify-content: space-around;
        width: 100%;
        position: inherit;
      }

      .atelie-layout-menu > a {
        width: 140px;
      }
}
</style>

<style scoped>
/*Transição entre paginas*/
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.8s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.btn {
  font-size: 1.5rem;
}
.afazer {
  color: #dc3545;
  border-color: #dc3545;
}
.afazer:hover {
  color: white;
  background: #dc3545;
}
.size {
  margin-top: 6rem;
  height: 5rem;
  position: fixed;
}
.navbar {
  background: rgba(255, 255, 255, 0.596);
  color: rgb(0, 0, 0);
  border-bottom-left-radius: 0.5rem;
  border-bottom-right-radius: 0.5rem;
}
.links {
  margin-top: 4rem;
}
.conteudo {
  margin-top: 1rem;
  background: white;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

@media only screen and (min-width: 768px) {
  .conteudo {
    margin-left: 12rem;
  }
}
@media only screen and (min-width: 1200px) {
  .conteudo {
    margin-left: 13rem;
  }
}
@media only screen and (min-width: 1323px) {
  .conteudo {
    margin-left: 19.5rem;
  }
}
</style>

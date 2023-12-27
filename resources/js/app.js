require("./bootstrap");

import { createApp } from "vue";
import Layout from "./Pages/Layout.vue";
import router from "./Routes/Router";

const app = createApp({}).use(router);
app.component("layout", Layout).mount("#app");

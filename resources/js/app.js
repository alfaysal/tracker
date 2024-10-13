import "./bootstrap";
import '../css/app.css'
import router from "./router";

import { createApp } from "vue";
import app from "./layouts/app.vue";

createApp(app).use(router).mount("#app");

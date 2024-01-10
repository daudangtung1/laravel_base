require("./bootstrap");

import { createApp } from "vue";
import App from "./App.vue";
import router from "./routes";
import axios from "axios"

axios.defaults.baseURL = 'http://art-app.test/api/v1/';

createApp(App)
    .use(router)
    .mount("#app");

import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import 'bootstrap' 
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";

const vuetify = createVuetify({
    components: {
        ...components
    },
});

const app = createApp(App)

app.use(router)
.use(vuetify)

app.mount('#app')

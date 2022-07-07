require('./bootstrap')

import { createApp } from 'vue';

import App from './layouts/App.vue';
import router from './Router.js';

createApp(App)
.use(router)
.mount('#app')

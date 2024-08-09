import { createApp } from 'vue';
import App from '@/App.vue';
import {router} from "@/plugins/router/index.js";
import { registerPlugins } from '@core/utils/plugins';
import '@core/scss/template/index.scss';
import '@layouts/styles/index.scss';

// Create Vue admin instance
const admin = createApp(App);

// Register plugins
registerPlugins(admin);

// Use router
admin.use(router);

// Mount Vue admin app to #admin
admin.mount('#admin');

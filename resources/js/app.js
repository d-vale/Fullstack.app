import { createApp } from 'vue';
import { setDefaultHeaders } from '@/utils/fetchJson.js';
import App from './App.vue';

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';
setDefaultHeaders({'X-CSRF-TOKEN': csrfToken});


const myApp = createApp(App);
myApp.mount('#app');

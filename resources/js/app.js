import { createApp } from 'vue'
// import HelloWorld from './components/HelloWorld.vue';
import MapApp from './components/MapApp.vue';

const app = createApp({});
app.component('map-app', MapApp)
    .mount('#app');

require('./bootstrap');
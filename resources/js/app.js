import { createApp } from 'vue'
import HelloWorld from './components/HelloWorld.vue';
import MapApp from './components/MapApp.vue';

import 'leaflet/dist/leaflet.css';

/** Eventbus creeren **/
import mitt from 'mitt';
export const eventHub = mitt();

const app = createApp({});
app.component('map-app', MapApp)
    .mount('#app');

require('./bootstrap');
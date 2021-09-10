import { createApp } from 'vue'
import HelloWorld from './components/HelloWorld.vue';
import MapApp from './components/MapApp.vue'


import 'leaflet/dist/leaflet.css'

// Font Awesome
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons'
library.add(fas);
import { dom } from "@fortawesome/fontawesome-svg-core";
dom.watch();


/** Eventbus creeren **/
import mitt from 'mitt'
export const eventHub = mitt()

const app = createApp({});
app.component('map-app', MapApp)
    .mount('#app')

app.component('font-awesome-icon', FontAwesomeIcon);

require('./bootstrap');
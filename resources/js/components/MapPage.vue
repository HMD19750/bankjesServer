<template>
  <div id="myMap" style="width: 100%; height: 100%"></div>
  <menu-button/>
</template>

<script >
import { defineComponent } from "vue";
import L from "leaflet";
import icons from "../mixins/icons.js";
import { eventHub } from "../app";
import MenuButton from "./MenuButton.vue";

const axios = require("axios");

export default defineComponent({
  name: "MapPage",

  components: {MenuButton},

  mixins: [icons],

  data() {
    return {
      bankjes: {},
      moveDebounce: false, //Nodig om moveend af te vangen die wordt gegenereerd bij map initialisatie
      markerLayerGroup: null,
      map: null,
      tileLayer: null,
      layers: [],
      zoom: 15,
      centerMap: [51, 6],
      userPosition: [51, 6],
      userPositionIcon: null,
      aantalBankjes: 0,
    };
  },

  mounted() {
    var options = { enableHighAccuracy: true };
    navigator.geolocation.getCurrentPosition(
      this.CurrentLocationFound,
      this.CurrentLocationNotFound,
      options
    );
  },

  methods: {
    InitAtMounted() {
      this.centerMap = this.userPosition;
      this.map = this.initMap();
      this.getBankjes();
        setTimeout(this.createEventHandlers(), 1000);
      // this.touchServer();

      this.userPositionIcon = L.marker(this.userPosition, {
        icon: this.centerIcon,
      }).addTo(this.map);
    },

    createEventHandlers() {
      this.map.on("moveend", () => {
        if (this.moveDebounce) {
          this.markerLayerGroup.clearLayers();
          this.getBankjes();
        }
        this.moveDebounce = true;
      });

      eventHub.on("reCenter", this.reCenter);
    },

    initMap() {
      let map = L.map("myMap", { zoomControl: true }).setView(
        this.centerMap,
        this.zoom
      );

      this.tileLayer = L.tileLayer(
        "https://tile.thunderforest.com/landscape/{z}/{x}/{y}.png?apikey=1fb130da39e54a4da19c2bdafc660da8",
        {
          attribution:
            '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
        }
      ).addTo(map);

      setTimeout(function () {
        map.invalidateSize();
      }, 300);

      L.control.scale({ imperial: false }).addTo(map);

      return map;
    },

    calculateRetrievalArea(center) {
      var boundingBox = this.map.getBounds();
      let lngLow, lngHigh, latLow, latHigh;
      if (boundingBox.getWest() == boundingBox.getEast()) {
        //Om fout resultaat van eerste aanroep boundingBox op te vangen!
        lngLow = center.lng - 0.05;
        lngHigh = center.lng + 0.05;
        latLow = center.lat - 0.05;
        latHigh = center.lat + 0.05;
      } else {
        lngLow = boundingBox.getSouthWest().lng;
        latLow = boundingBox.getSouthWest().lat;
        lngHigh = boundingBox.getNorthEast().lng;
        latHigh = boundingBox.getNorthEast().lat;
      }
      return {
        lngLow: lngLow,
        lngHigh: lngHigh,
        latLow: latLow,
        latHigh: latHigh,
      };
    },

    getBankjes() {
      let vertices = this.calculateRetrievalArea(this.map.getCenter());
      axios
        .get(
          "/api/area?lngLow=" +
            vertices.lngLow +
            "&lngHigh=" +
            vertices.lngHigh +
            "&latLow=" +
            vertices.latLow +
            "&latHigh=" +
            vertices.latHigh +
            "&number=200"
        )
        // .get("https://www.evenuitrusten.nl/api/area/test")
        .then((response) => {
          this.bankjes = response.data;
          console.log("Bankjes: axios has returned data");
          this.placeMarkers(this.bankjes);
          this.aantalBankjes = this.bankjes.length;
          return this.bankjes;
        })
        .catch(function (error) {
          // handle error
          console.log("MyError bankjes:" + error.response);
        });
    },

    // Method om voor ieder bankje in array "bankjes" een marker te zetten
    placeMarkers(bankjes) {
      this.markerLayerGroup = L.layerGroup().addTo(this.map);
      for (let i = 0; i < bankjes.length; i++) {
        if (bankjes[i].typeBankje == "picnicbankje") {
          this.icon = this.picnicBankjeIcon;
        }
        if (bankjes[i].typeBankje == "schuilhut") {
          this.icon = this.schuilhutIcon;
        }
        if (bankjes[i].typeBankje == "bankje") {
          this.icon = this.bankjeIcon;
        }

        bankjes[i].marker = L.marker(
          this.toLatLng(bankjes[i].Latitude, bankjes[i].Longitude),
          {
            icon: this.icon,
          }
        ).addTo(this.markerLayerGroup);
      }
    },

    reCenter() {
      this.map.flyTo(this.userPosition, this.zoom);
    },

    CurrentLocationFound(pos) {
      console.log("CurrentLocationFound hit");
      this.userPosition = this.toLatLng(
        pos.coords.latitude,
        pos.coords.longitude
      );
      this.InitAtMounted();
    },

    CurrentLocationNotFound(err) {
      console.log("CurrentLocationNotFound hit");
      console.log("getLocation returned " + err);
      this.userPosition = this.toLatLng(51.430207, 5.982087);
      this.InitAtMounted();
    },

    // Hulpfunctie im lat en lng naar array te converteren
    toLatLng(lat, lng) {
      return [lat, lng];
    },
  },
});
</script>

<style scoped>
.no-scroll {
  --overflow: hidden;
}

#myMap {
  width: 100vw;
  height: 100vh;
  position: absolute;
  top: 0;
  left: 0;
}
</style>

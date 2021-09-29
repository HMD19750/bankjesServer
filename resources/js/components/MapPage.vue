<template>
  <div id="myMap" style="width: 100%; height: 100%"></div>
</template>

<script >
import { defineComponent } from "vue";
import L from "leaflet";
import icons from "../mixins/icons.js";
import { eventHub } from "../app";


const axios = require("axios");

export default defineComponent({
  name: "MapPage",

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
      baseUrl:'https://www.evenuitrusten.nl'
    };
  },

  created() {
    eventHub.on("addBankje", (e) => this.addObject("bankje", e));
    eventHub.on("addPicnicBankje", (e) => this.addObject("picnicbankje", e));
    eventHub.on("addSchuilhut", (e) => this.addObject("schuilhut", e));
    eventHub.on("deleteBankje", this.deleteBankje);
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
      console.log(this.userPosition);
      this.map = this.initMap();
      this.getBankjes();
      setTimeout(this.createEventHandlers(), 1000);
      this.touchServer();

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

        // Touching the server for log purposes
    touchServer() {
      axios
        .post(this.baseUrl+"/api/bankje/touch", {
          lat: this.userPosition[0],
          lng: this.userPosition[1],
        })
        .catch(function (error) {
          console.log(error);
        });
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
        .get(this.baseUrl+
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

   addObject(object) {
      const objectProperties = {
        bankje: {
          naam: "bankje",
          icon: this.bankjeIcon,
        },
        picnicbankje: {
          naam: "picnicbankje",
          icon: this.picnicBankjeIcon,
        },
        schuilhut: {
          naam: "schuilhut",
          icon: this.schuilhutIcon,
        },
      };

      var bankje = {
        lat: this.map.getCenter().lat,
        lng: this.map.getCenter().lng,
        typeBankje: objectProperties[object].naam,
      };

      axios
        .post(this.baseUrl+"/api/bankje", bankje)
        .then((response) => {
          // console.log("Bankje added to server");
          this.bankjes.push(response.data);
          this.bankjes[this.bankjes.length - 1].marker = L.marker(
            this.map.getCenter(),
            { icon: objectProperties[object].icon }
          ).addTo(this.markerLayerGroup);
        })
        .catch(function (error) {
          console.log(error);
        });
    },

       // Verwijder het bankje dat voldoende dicht bij het centrum staat
    deleteBankje() {
      // console.log(this.zoekGebied());
      let bankjesFound = this.bankjes.filter(this.inZoekGebied);
      if (bankjesFound.length == 1) {
        console.log("Een gevonden");
        axios
          .delete(this.baseUrl+
            "/api/bankje/" + bankjesFound[0].id
          )
          .catch(function (error) {
            console.log("Error in FrontPage-deleteBankje:" + error);
          });
        this.map.removeLayer(bankjesFound[0].marker);
      } else {
        console.log("geen bankje gevonden om te deleten");
      }
    },

    zoekGebied() {
      var coordinateRange = (this.straalZoekGebied() * 360) / 36000000; //Omrekening naar decimale graden
      var bounds = {
        lowLat: this.map.getCenter().lat - coordinateRange,
        highLat: this.map.getCenter().lat + coordinateRange,
        lowLng: this.map.getCenter().lng - coordinateRange,
        highLng: this.map.getCenter().lng + coordinateRange,
      };
      return bounds;
    },

    // Filterfunctie om te kijken of er een bankje is dat dicht genoeg bij het centrum ligt
    inZoekGebied(bankje) {
      // L.rectangle([[this.zoekGebied.lowLat,this.zoekGebied.lowLng],[this.zoekGebied.highLat,this.zoekGebied.highLng]],{color: "#ff7800", weight: 1, fill:false}).addTo(this.map);
      if (
        bankje.Latitude > this.zoekGebied().lowLat &&
        bankje.Latitude < this.zoekGebied().highLat &&
        bankje.Longitude > this.zoekGebied().lowLng &&
        bankje.Longitude < this.zoekGebied().highLng
      ) {
        return true;
      } else {
        return false;
      }
    },

        straalZoekGebied() {
      return Math.pow(2, 16 - this.map.getZoom()) * 40; //Straal zoekgebied gaat mee met zoom factor
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

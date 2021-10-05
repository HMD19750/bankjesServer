<template>
<div>
  <flash>
      Zelf een bankje toevoegen
  </flash>

  <div class="centercross front">
    <svg height="150" width="150">
      <line
        x1="75"
        y1="0"
        x2="75"
        y2="65"
        style="stroke: rgb(255, 0, 0); stroke-width: 2"
      />
      <line
        x1="75"
        y1="85"
        x2="75"
        y2="150"
        style="stroke: rgb(255, 0, 0); stroke-width: 2"
      />
      <line
        x1="0"
        y1="75"
        x2="65"
        y2="75"
        style="stroke: rgb(255, 0, 0); stroke-width: 2"
      />
      <line
        x1="85"
        y1="75"
        x2="150"
        y2="75"
        style="stroke: rgb(255, 0, 0); stroke-width: 2"
      />
    </svg>
  </div>

  <div class="centermenu front">
    <div style="transform: translate(85px, 0px)">
      <a href="#" style="pointer-events: auto" @click.prevent="addBankje">
        <svg height="75" width="75">
          <path
            d="M0 65 L0 0  A 65 65 0 0 1 65 65 z"
            style="
              fill: #1365f2;
              stroke: #000000;
              stroke-width: 0.55;
              stroke-linejoin: round;
              stroke-miterlimit: 4;
              stroke-dasharray: none;
              stroke-opacity: 1;
              paint-order: markers fill stroke;
              fill-opacity: 1;
              opacity: 0.5;
            "
            fill="none"
          />
        </svg>
      </a>

      <img
        src="../assets/images/bankje256x256.png"
        width="80"
        heigth="80"
        class="ttr"
        @click.prevent="addBankje"
      />
    </div>

    <!-- Segment links boven -->
    <div style="transform: translate(0px, -163px)">
      <a href="#" @click.prevent="addPicnicBankje" style="pointer-events: auto">
        <svg height="75" width="75">
          <path
            d="M65 65 L0 65 A 65 65 0 0 1 65 0 "
            style="
              fill: #1365f2;
              stroke: #000000;
              stroke-width: 0.55;
              stroke-linejoin: round;
              stroke-miterlimit: 4;
              stroke-dasharray: none;
              stroke-opacity: 1;
              paint-order: markers fill stroke;
              fill-opacity: 1;
              opacity: 0.5;
            "
            fill="none"
          />
        </svg>
      </a>

      <img
        src="../assets/images/picnictafel200x200.png"
        width="80"
        height="80"
        class="ttl"
        @click.prevent="addPicnicBankje"
      />
    </div>

    <!-- Segment rechts onder -->
    <div style="transform: translate(85px, -240px)">
      <a href="#" @click.prevent="exitBankje" style="pointer-events: auto">
        <svg height="75" width="75">
          <path
            d="M 0 0 L65 0 A 65 65 0 0 1 0 65 z "
            style="
              fill: #1365f2;
              stroke: #000000;
              stroke-width: 0.55;
              stroke-linejoin: round;
              stroke-miterlimit: 4;
              stroke-dasharray: none;
              stroke-opacity: 1;
              paint-order: markers fill stroke;
              fill-opacity: 1;
              opacity: 0.5;
            "
            fill="none"
          />
        </svg>
      </a>

      <img
        src="../assets/images/cross.png"
        width="80"
        height="80"
        class="tbr"
        @click.prevent="exitBankje"
      />
    </div>

    <!-- Segment links onder -->
    <div style="transform: translate(0px, -405px)">
      <div style="transform: rotate(90deg) translate(0px, 10px)">
        <a href="#" @click.prevent="exitBankje" style="pointer-events: auto">
          <svg height="75" width="75">
            <path
              d="M 0 0 L65 0 A 65 65 0 0 1 0 65 z "
              style="
                fill: #1365f2;
                stroke: #000000;
                stroke-width: 0.55;
                stroke-linejoin: round;
                stroke-miterlimit: 4;
                stroke-dasharray: none;
                stroke-opacity: 1;
                paint-order: markers fill stroke;
                fill-opacity: 1;
                opacity: 0.5;
              "
              fill="none"
            />
          </svg>
        </a>
      </div>

      <img
        src="../assets/images/schuilhutIcon.png"
        width="80"
        height="80"
        class="tbl"
        @click.prevent="addSchuilhut"
      />
    </div>
  </div>
</div>
</template>

<script>
import { eventHub } from "../app";
import flash from "./Flash.vue";


export default {

  components: { flash },


  mounted() {
    // console.log("Addmenu mounted");
  },

  methods: {
    exitBankje() {
      // console.log("AddMenu.vue: ExitBankje hit");
      eventHub.emit("endAdd");
    },

    addBankje() {
      // console.log("AddMenu.vue: addBankje hit");
      eventHub.emit("addBankje");
      eventHub.emit("endAdd");
    },

    addPicnicBankje() {
      // console.log("AddMenu.vue: addPicnicBankje hit");
      eventHub.emit("addPicnicBankje");
      eventHub.emit("endAdd");
    },

    addSchuilhut() {
      // console.log("AddMenu.vue: addSchuilhut hit");
      eventHub.emit("addSchuilhut");
      eventHub.emit("endAdd");
    },
  },
};
</script>

<style scoped>
.front {
  z-index: 2222;
}

.centercross {
  position: absolute;
  top: 50%;
  left: 50%;
  margin-top: -75px;
  margin-left: -75px;
  width: 150px;
  height: 150px;
}

.centermenu {
  position: absolute;
  top: 50%;
  left: 50%;
  margin-top: -75px;
  margin-left: -75px;
  width: 75px;
  height: 75px;
}

.ttr {
  pointer-events: auto;
  transform: scale(0.5, 0.5) translate(-10px, -150px);
}

.ttl {
  pointer-events: auto;
  transform: scale(0.5, 0.5) translate(-10px, -150px);
}

.tbr {
  pointer-events: auto;
  transform: scale(0.5, 0.5) translate(-10px, -180px);
}

.tbl {
  pointer-events: auto;
  transform: scale(0.5, 0.5) translate(-0px, -180px);
}


</style>

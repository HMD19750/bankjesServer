<template>
  <flash>
      Zelf een bankje verwijderen
  </flash>
  <div class="centermenu front"  >
         <svg height="150" width="150">
        <line
          x1="75"
          y1="0"
          x2="75"
          y2="55"
          style="stroke: rgb(255, 0, 0); stroke-width: 2"
        />
        <line
          x1="75"
          y1="95"
          x2="75"
          y2="150"
          style="stroke: rgb(255, 0, 0); stroke-width: 2"
        />
        <line
          x1="0"
          y1="75"
          x2="55"
          y2="75"
          style="stroke: rgb(255, 0, 0); stroke-width: 2"
        />
        <line
          x1="95"
          y1="75"
          x2="150"
          y2="75"
          style="stroke: rgb(255, 0, 0); stroke-width: 2"
        />
      </svg>


    <div style="transform: translate(85px, -155px);" class="front">
        <a href="#" @click.prevent="deleteBankje" style="pointer-events: auto;">
          <svg height="75" width="75">
            <path
              d="M0 55 L0 0  A 65 65 0 0 1 65 65 L10 65z"
              style="
                fill: #4d4d4d;
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
      src="../assets/images/minus.png"
      width="40"
      height="40"
      class="centermenu ttr"
      @click.prevent="deleteBankje"
    />
    </div>

<!-- Segment rechts onder -->
    <div style="transform: translate(85px, -150px);" class="front">
        <a href="#" @click.prevent="exitBankje" style="pointer-events: auto;">
          <svg height="75" width="75">
            <path
              d="M 10 0 L65 0 A 65 65 0 0 1 0 65 L0 10z "
              style="
                fill: #4d4d4d;
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
      width="40"
      height="40"
      class="centermenu tbr"
      @click.prevent="exitBankje"
    />
    </div>

  </div>

</template>

<script>
import { eventHub } from "../app";
import flash from "./Flash.vue";

export default {
     components: { flash },



  methods: {
    deleteBankje() {
      console.log("DeleteBankje.vue: deleteBankje emitted");
      eventHub.emit("deleteBankje");
      eventHub.emit("endDelete");
    },

    exitBankje() {
      console.log("DeleteBankje.vue: endDelete emitted");
      eventHub.emit("endDelete");
    },
  },
};
</script>

<style scoped>
.front {
    z-index:2222;
}


.centermenu {
  position: absolute;
  top: 50%;
  left: 50%;
  margin-top: -75px;
  margin-left: -75px;
  width: 150px;
  height: 150px;
}

.ttr {
  pointer-events: auto;
  transform: scale(0.3, 0.3) translate(-150px, -0px);
}

.tbr {
  pointer-events: auto;
  transform: scale(0.3, 0.3) translate(-150px, -25px);
}


</style>

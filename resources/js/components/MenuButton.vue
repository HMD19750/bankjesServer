<template>
  <div  class="menu">
    <button class="MenuButton" href="#" @click="reCenter">
      <i class="menuIcon fas fa-location-arrow"></i>
    </button>
    <button class="MenuButton" href="#" @click="startAdd">
      <i class="menuIcon fas fa-plus"></i>
    </button>
    <button class="MenuButton" href="#" @click="startDelete">
      <i class="menuIcon fas fa-minus"></i>
    </button>
    <button class="MenuButton" href="#" @click="showDocumentation">
      <i class="menuIcon fas fa-info"></i>
    </button>

    <b-badge pill variant="primary">Primary</b-badge>
  </div>
</template>

<script>
import { eventHub } from "../app";

export default {

  mounted() {
    console.log("MenuButton started");
  },

  components: {},

  data() {
    return {

      //   locationArrow: faLocationArrow,
      //   plus: faPlus,
      //   minus: faMinus,
      //   info: faInfo,
    };
  },

  methods: {
    reCenter() {
      console.log("Emitted reCenter");
      eventHub.emit("reCenter");
    },

    startAdd() {
      console.log("Menubar.vue: Emitted startAdd");
      eventHub.emit("startAdd");
    },

        startDelete() {
      console.log("Menubar.vue: Emitted startDelete");
      eventHub.emit("startDelete");
    },

    showDocumentation() {
      console.log("Menubar.vue: Emitted showDocumentation");
      eventHub.emit("showDocumentation");
    },
  },
};
</script>

<style scoped>
.menu {
  display: flex;
  flex-direction: column;
  position: absolute;
  z-index: 9999;
  top: 5%;
  right: 5%;
}

.MenuButton {
  width: 40px;
  height: 40px;
  border-radius: 100%;
  background-color: #3dc2ff;
  outline: none;
  margin-top: 10px;
  border: none;
  color: white;
  transition-duration: 0.4s;
}
.MenuButton:hover {
  background-color: #4caf50; /* Green */
  color: white;
}

.menuItem {
  color: white;
  background-color: white;
  fill: white;
}

.btn {
  background-color: DodgerBlue; /* Blue background */
  border: none; /* Remove borders */
  color: white; /* White text */
  padding: 12px 16px; /* Some padding */
  font-size: 16px; /* Set a font size */
  cursor: pointer; /* Mouse pointer on hover */
}

/* Darker background on mouse-over */
.btn:hover {
  background-color: RoyalBlue;
}
</style>

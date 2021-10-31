<template>
<div>
  <div class="menu">
    <button class="MenuButton" href="#" @click="reCenter">
      <i class="menuIcon fas fa-location-arrow"></i>
    </button>
    <button
      class="MenuButton"
      href="#"
      @click="startAdd"
      v-if="!showAddedDeletedIcons"
    >
      <i class="menuIcon fas fa-plus"></i>
    </button>
    <button
      class="MenuButton"
      href="#"
      @click="startDelete"
      v-if="!showAddedDeletedIcons"
    >
      <i class="menuIcon fas fa-minus"></i>
    </button>
    <button class="MenuButton" href="#" @click="showDocumentation">
      <i class="menuIcon fas fa-info"></i>
    </button>
    <button
      class="MenuButton"
      href="#"
      @click="hideAddedDeleted"
      style="background-color: red"
      v-if="showAddedDeletedIcons"
    >
      <i class="menuIcon fas fa-book-open"></i>
    </button>
  </div>
  <flash v-if="showAddedDeletedIcons">Now showing added and deleted benches</flash>
 
</div>
</template>

<script>
import { eventHub } from "../app";
import flash from "./Flash.vue";

// Button sequence die app in addedDeleted mode zet
const SECRET_COMBINATION = [
  "reCenter",
  "reCenter",
  "reCenter",
  "reCenter",
  "startAdd",
];

export default {
  components: {flash},

  data() {
    return {
      showAddedDeletedIcons: false,
      buttonStack: [],
    };
  },

  methods: {
    reCenter() {
      eventHub.emit("reCenter");
      this.addToButtonStack("reCenter");
    },

// Opent add -menu
    startAdd() {
      eventHub.emit("startAdd");
      this.addToButtonStack("startAdd");
    },
//Opent delete-menu
    startDelete() {
      eventHub.emit("startDelete");
      this.addToButtonStack("startDelete");
    },

//Opent Documentatie modal
    showDocumentation() {
      eventHub.emit("showDocumentation");
      this.addToButtonStack("showDocumentation");
    },

// Switched van addedDeleted mode naar normal mode
    hideAddedDeleted() {
      this.showAddedDeletedIcons = false;
      eventHub.emit("hideAddedDeleted");
    },

// Controleert op geheime button sequence
    addToButtonStack(buttonPressed) {
      this.buttonStack.push(buttonPressed);
      if (this.buttonStack.length > 5) {
        this.buttonStack.shift();
      }
      if (this.secretCombinationPressed()) {
        eventHub.emit("showAddedDeleted");
        eventHub.emit("endAdd");
        this.showAddedDeletedIcons = true;
      }
    },

    secretCombinationPressed() {
      return JSON.stringify(this.buttonStack) == JSON.stringify(SECRET_COMBINATION) ?  true :  false 
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
  top: 0%;
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

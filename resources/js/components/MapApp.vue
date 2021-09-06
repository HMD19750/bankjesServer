<template>
  <div>Dit is App.vue</div>
</template>

<script >
// import { defineComponent } from "vue";
// import MapPage from "./components/MapPage.vue";
// import AddMenu from "./components/AddMenu.vue";
// import { eventHub } from "./app";

export default {
  name: "MapApp",

  components: {
    // AddMenu,
    // MapPage,
  },

  data() {
    return {
      dataReceived: false,
      showAddOverlay: false,
      showDeleteOverlay: false,
      showConfirmOverlay: false,
    };
  },

    mounted() {
    // eventHub.on("startAdd", this.startAdd);
    // eventHub.on("endAdd", this.endAdd);
    // eventHub.on("startDelete", this.startDelete);
    // eventHub.on("endDelete", this.endDelete);
    // eventHub.on("startConfirm", this.startConfirm);
    // eventHub.on("endConfirm", this.endConfirm);
  },

  methods: {


  }

};
</script>

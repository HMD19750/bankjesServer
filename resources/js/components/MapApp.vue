<template>
  <div>
      <map-page></map-page>
  </div>
</template>

<script >
import { defineComponent } from "vue";
import MapPage from "../components/MapPage.vue";
import { eventHub } from "../app";

export default defineComponent({
 name: "MapApp",

  components: {
    // AddMenu,
    MapPage,
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
    eventHub.on("startAdd", this.startAdd);
    eventHub.on("endAdd", this.endAdd);
    // eventHub.on("startDelete", this.startDelete);
    // eventHub.on("endDelete", this.endDelete);
    // eventHub.on("startConfirm", this.startConfirm);
    // eventHub.on("endConfirm", this.endConfirm);
  },

  methods: {
          startAdd() {
      // console.log("App.vue: Hit eventhandler voor startAdd");
      this.showAddOverlay = true;
      this.showDeleteOverlay = false;
    },

        endAdd() {
      // console.log("App.vue: Hit eventhandler voor endAdd");
      this.showAddOverlay = false;
    },

  }
});
</script>

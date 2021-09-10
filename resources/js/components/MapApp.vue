<template>
  <div>
    <map-page></map-page>
    <menu-button></menu-button>
    <documentation-modal v-if="showModal"></documentation-modal>
  </div>
</template>

<script >
import { defineComponent } from "vue";
import MapPage from "../components/MapPage.vue";
import { eventHub } from "../app.js";
import MenuButton from "./MenuButton.vue";
import DocumentationModal from "./DocumentationModal.vue";

export default defineComponent({
  name: "MapApp",

  components: {
    // AddMenu,
    MapPage,
    MenuButton,
    DocumentationModal,
  },

  data() {
    return {
      dataReceived: false,
      showAddOverlay: false,
      showDeleteOverlay: false,
      showConfirmOverlay: false,
      showModal: false,
    };
  },

  mounted() {
    eventHub.on("startAdd", this.startAdd);
    eventHub.on("endAdd", this.endAdd);
    // eventHub.on("startDelete", this.startDelete);
    // eventHub.on("endDelete", this.endDelete);
    // eventHub.on("startConfirm", this.startConfirm);
    // eventHub.on("endConfirm", this.endConfirm);
    eventHub.on("showDocumentation", this.openModal);
    eventHub.on("closeDocumentation", this.closeModal);
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

    openModal() {
    //   console.log("MapApp.vue: openModal hit");
      this.showModal = true;
    },

    closeModal() {
    //   console.log("MapApp.vue: closeModal hit");
      this.showModal = false;
    },
  },
});
</script>

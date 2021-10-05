<template>
  <div>
    <map-page></map-page>
    <menu-button v-if="showMenu"></menu-button>
    <documentation-modal v-if="showModal"></documentation-modal>
    <add-menu v-if="showAddOverlay"></add-menu>
    <delete-menu v-if="showDeleteOverlay"></delete-menu>
  </div>
</template>

<script >
import { defineComponent } from "vue";
import MapPage from "../components/MapPage.vue";
import { eventHub } from "../app.js";
import MenuButton from "./MenuButton.vue";
import DocumentationModal from "./DocumentationModal.vue";
import AddMenu from "./AddMenu.vue";
import DeleteMenu from "./DeleteMenu.vue";

export default defineComponent({
  name: "MapApp",

  components: {
    AddMenu,
    DeleteMenu,
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
      showMenu: true
    };
  },

  mounted() {
    eventHub.on("startAdd", this.startAdd);
    eventHub.on("endAdd", this.endAdd);
    eventHub.on("startDelete", this.startDelete);
    eventHub.on("endDelete", this.endDelete);
    eventHub.on("startConfirm", this.startConfirm);
    eventHub.on("endConfirm", this.endConfirm);
    eventHub.on("showDocumentation", this.openModal);
    eventHub.on("closeDocumentation", this.closeModal);
  },

  methods: {
    startAdd() {
      // console.log("MapApp: Hit eventhandler voor startAdd");
      this.showAddOverlay = true;
      this.showDeleteOverlay = false;
    },

    endAdd() {
      // console.log("MapApp: Hit eventhandler voor endAdd");
      this.showAddOverlay = false;
    },

        startDelete() {
      // console.log("MapApp.vue: Hit eventhandler voor startDelete");
      this.showDeleteOverlay = true;
      this.showAddOverlay = false;
    },

    endDelete() {
      // console.log("MapApp.vue: Hit eventhandler voor EndDelete");
      this.showDeleteOverlay = false;
    },

    openModal() {
      // console.log("MapApp.vue: openModal hit");
      this.showModal = true;
      this.showMenu=false;
      this.showAddOverlay = false;
      this.showDeleteOverlay = false;
    },

    closeModal() {
    //   console.log("MapApp.vue: closeModal hit");
      this.showModal = false;
      this.showMenu=true;
    },
  },
});
</script>

<template>
  <div>
    <transition name="fade">
      <div class="flash" v-show="elementVisible"><slot></slot></div>
    </transition>
  </div>
</template>

<script>
export default {
  name: "Flash",

  data() {
    return {
      elementVisible: true,

    };
  },

  created() {
    setTimeout(() => (this.elementVisible = false), 2000);
  },
};
</script>

<style scoped>
.flash {
  color: white;
  display: block;
  border-radius: 10px;
  z-index: 9999;
  position: absolute;
  top: 30%;
  left: 50%;
  transform: translate(-50%, 0);
  background-color: mediumblue;
  padding: 10px;
  opacity: 0.5;
  text-align: center;
  font-family: "Helvetica";
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>


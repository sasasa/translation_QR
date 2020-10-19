<template>
  <div>
    <div class="fullview">
      <div class="loading-spacer"></div>
      <vue-loading 
        type="spiningDubbles"
        color="#aaa"
        v-bind:size="{ width: '100px', height: '100px' }"
        >
      </vue-loading>
    </div>
  </div>
</template>

<script>
import { VueLoading } from 'vue-loading-template'

export default {
  name: 'loading',
  components: {
    VueLoading,
  },

}
</script>

<style>
.fullview {
  width: 100%;
  height: 100%;
  background: rgba(255,255,255,0.7);
  z-index: 100;
  position: fixed;
  top: 0;
  left: 0;
}
.loading-spacer {
  height: 30%;
}
</style>
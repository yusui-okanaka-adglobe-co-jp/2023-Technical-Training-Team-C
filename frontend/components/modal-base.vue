<template>
  <Teleport to="body" v-if="props.isShown">
    <div class="modal-overlay" @click.stop="isShown = false">
      <div class="modal-content" @click.stop="doNothing">
        <slot> </slot>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
const props = defineProps({
  isShown: false,
})

function doNothing() {}
</script>

<style>
.modal-overlay {
  position: fixed;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  top: 0;
  left: 0;
}

.modal-content {
  background-color: #5160ae;
  width: 270px;
  height: auto;
}
</style>

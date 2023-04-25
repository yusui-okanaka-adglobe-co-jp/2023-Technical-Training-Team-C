<template>
  <default-layout page-name="教師用ページ">
    <!-- html記述場所 -->
    <!-- <button @click="onclick">日付選択</button> -->
    <calendar-modal3 :is-shown="isShown"> </calendar-modal3>
  </default-layout>
</template>

<script lang="ts" setup>
import ModalBase from '~~/components/modal-base.vue'
const isShown = ref(false)

function onclick() {
  isShown.value = !isShown.value
}
</script>

<style scoped lang="scss"></style>

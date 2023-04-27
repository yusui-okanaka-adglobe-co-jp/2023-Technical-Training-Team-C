<template>
  <default-layout page-name="生徒用ページ">
    <!-- html記述場所 -->
    <div>
      <button class="usual-button" @click="onclick">
        <div class="date-select">日付選択</div>
      </button>
      <calendar-modal :is-shown="isShown" @update:value="selectDate"> </calendar-modal>
    </div>
  </default-layout>
</template>

<script setup>
import ModalBase from '~~/components/modal-base.vue'
import { format } from 'date-fns'

const isShown = ref(false)

function onclick() {
  isShown.value = !isShown.value
}

const view = ref(null)

function selectDate(e) {
  view.value = e

  //カレンダーモーダルを閉じる
  isShown.value = false

  return navigateTo({
    path: '/studentHome',
    query: {
      view: format(view.value, 'yyyy-MM-dd'),
    },
  })
}
</script>

<style scoped lang="scss">
body {
  padding-left: 20px;
}
.date-select {
  color: #5160ae;
  font-size: 24px;
}
</style>

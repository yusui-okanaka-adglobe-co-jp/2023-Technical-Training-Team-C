<template>
  <default-layout page-name="生徒用ページ">
    <!-- html記述場所 -->
    <div>
      <button @click="onclick">
        <div class="dateselect">日付選択</div>
      </button>
      <!-- <p>{{ view }}</p> -->
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

  async function timetableRequest() {
    const $config = useRuntimeConfig()
    try {
      const response =
        (await $fetch) <
        SampleResponse >
        (`${$config.public.apiUrl}/api/sample`,
        {
          method: 'get',
          body: {
            date: view.value,
          },
        })

      logs.value.push(response)
    } catch (ex) {
      console.error(ex)
    }
  }
}
</script>

<style scoped lang="scss">
button {
  background-color: white;
  margin-top: 24px;
  padding: 8px 16px;
  font-weight: bold;
  border-radius: 10px;
  border: solid 3px #5160ae;
  margin: 20px;
}

.dateselect {
  color: #5160ae;
  font-size: 14px;
}
</style>

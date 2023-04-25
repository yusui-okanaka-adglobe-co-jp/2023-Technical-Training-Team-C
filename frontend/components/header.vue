<template>
  <header>
    <div>
      <h1 class="font-size-xl">〇〇中学校時間割</h1>
      <h2 class="font-size-l">{{ props.pageName }}</h2>
    </div>
  </header>
</template>

<script lang="ts" setup>
const props = defineProps({
  pageName: String,
})
</script>

<style scoped lang="scss">
header {
  height: 100px;
  background-color: #89929b;
  div {
    padding: 15px 0px 15px 100px;
    h1 {
      margin: 0;
      font-style: normal;
      font-size: 36px;
    }
    h2 {
      margin: 0;
      font-size: 24px;
    }
  }
}
</style>

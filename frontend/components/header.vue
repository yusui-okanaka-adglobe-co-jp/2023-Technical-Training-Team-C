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
  h1 {
    font-style: normal;
  }
  div {
    padding: 15px 0px 15px 100px;
  }
}
</style>

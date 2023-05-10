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
  width: 100%;
  height: 100px;
  background-color: #89929b;
  div {
    padding: 15px 0px 15px 100px;
    h1 {
      font-style: normal;
    }
  }
}

// モバイル用スタイル
@media only screen and (max-width: 767px) {
  header {
    height: auto;
    div {
      margin: 0 auto;
      padding: 15px 0px 15px 0px;
      h1 {
        text-align: center;
      }
    }
  }
}
</style>

<template>
  <header>
    <div class="flex-box">
      <div class="titles">
        <h1 class="font-size-xl">{{ schoolName }}中学校時間割</h1>
        <h2 class="font-size-l">{{ props.pageName }}</h2>
      </div>
      <img src="~/assets/img/logo.png" class="logo" />
    </div>
  </header>
</template>

<script lang="ts" setup>
const schoolName = useRuntimeConfig().public.schoolName
const props = defineProps({
  pageName: String,
})
</script>

<style scoped lang="scss">
header {
  width: 100%;
  height: 100px;
  background-color: #89929b;
  h1 {
    font-style: normal;
  }
}

.flex-box {
  display: flex;
  position: relative;
}
.titles {
  padding: 15px 0px 15px 100px;
}
.logo {
  width: auto;
  height: 80px;
  margin-right: auto;
  margin-left: auto;
  position: absolute;
  left: 47%;
}
// モバイル用スタイル
@media only screen and (max-width: 767px) {
  header {
    height: auto;

    h1 {
      text-align: center;
    }
  }
  .titles {
    margin: 0 auto;
    padding: 15px 0px 15px 0px;
  }
  .logo {
    height: 75%;
    margin-left: 0px;
    left: 0%;
    margin-top: 8px;
  }
}
</style>

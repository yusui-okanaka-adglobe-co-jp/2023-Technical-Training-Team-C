<template>
  <default-layout page-name="ログイン画面">
    <div class="container">
      <section class="login">
        <div class="hero">
          <h1 class="title">ログイン</h1>
        </div>
        <div class="form">
          <p>メールアドレス：</p>
          <input type="text" required name="required" placeholder="メールアドレス入力" />
          <p>パスワード：</p>
          <input type="text" required name="required" placeholder="パスワード入力" /><br />
          <button class="button">ログインする</button>
        </div>
      </section>
    </div>
  </default-layout>
</template>

<script lang="ts" setup>
// layout: default,
// const props = defineProps ({
//     pageName: String,
// })
</script>

<style scoped lang="scss"></style>

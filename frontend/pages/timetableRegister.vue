<template>
  <default-layout page-name="教師用登録ページ">
    <body>
      <p class="dateset">
        開始日：<input type="date" value="start-date" /> 終了日：<input type="date" value="end-date" />
      </p>

      <p>
        <button onclick="location.href='./home'">
          <div class="home">ホーム</div>
        </button>
      </p>
      <p>
        <button onclick="window.open('/studentHome')">
          <div class="studentHome">生徒用画面確認</div>
        </button>
      </p>

      <p>
        <button onclick="location.href='./teachersLogin'">
          <div class="logout">ログアウト</div>
        </button>
      </p>

      <p>
        <button onclick="location.href='./home.html'">戻る</button>
        <button onclick="location.href='./timetableUpdate.html'">時間割更新</button>
      </p>
    </body>
  </default-layout>
</template>

<script lang="ts" setup>
import '@/assets/css/common.css'
import ModalBase from '~~/components/modal-base.vue'
import { format } from 'date-fns'

const today = new Date()
console.log(today)
</script>

<style lang="scss" scoped>
$background-color: #eaeaea;

body {
  padding-left: 20px;
}

input {
  margin-top: 40px;
  width: 224px;
  height: 40px;
  // padding-right: 160px;
}

button {
  background-color: white;
  width: 160px;
  height: 60px;

  // font-weight: bold;
  border-radius: 10px;
  border: solid 3px #5160ae;
  margin-top: 24px;

  // padding: 8px 16px;
  // margin: 20px;
}

.dateset {
  padding-left: 300px;
  font-size: 24px;
}

.home {
  color: #5160ae;
  font-size: 24px;
}

.studentHome {
  color: #5160ae;
  font-size: 18px;
}

.logout {
  color: #5160ae;
  font-size: 24px;
}
</style>

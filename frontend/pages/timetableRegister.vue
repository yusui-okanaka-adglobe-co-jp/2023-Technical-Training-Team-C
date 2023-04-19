<template>
  <div>
    <h1>hoge</h1>
    <p><button onclick="location.href='./home.html'">ホーム</button></p>
    <p><button onclick="window.open('/studentHome.html')">生徒用画面確認</button></p>
    <p><button class="logout" type="button">ログアウト</button></p>
    <p>
      開始日：<input type="date" name="example2" value="2022-04-18" /> 終了日：<input
        type="date"
        name="example2"
        value="2022-04-18"
      />
    </p>
    <p>
      <button onclick="location.href='./home.html'">戻る</button>
      <button onclick="location.href='./timetableUpdate.html'">時間割更新</button>
    </p>

    <dialog>
      <p>これはモーダルダイアログです</p>
      <button id="close">モーダルダイアログを閉じる</button>
    </dialog>
    <button id="show">モーダルダイアログを開く</button>
  </div>
</template>

<script lang="ts" setup></script>

<style lang="scss" scoped></style>

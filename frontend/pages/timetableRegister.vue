<template>
  <default-layout page-name="教師用登録ページ">
    <body>
      <div class="date-set">
        <button class="usual-button start-end-date" @click="onclick">
          <div class="dateselect">開始日終了日選択</div>
        </button>
        <label class="datetext">{{ start }}~{{ end }}</label>
        <calendar-modal-register :is-shown="isShown" @update:value="selectDate"> </calendar-modal-register>
      </div>

      <p>
        <button class="usual-button home" onclick="location.href='./home'">
          <div>ホーム</div>
        </button>
      </p>

      <p>
        <button class="usual-button student-home" onclick="window.open('/studentHome')">
          <div>生徒用画面確認</div>
        </button>
      </p>

      <p>
        <button class="usual-button logout" onclick="location.href='./teachersLogin'">
          <div>ログアウト</div>
        </button>
      </p>

      <TimetableComponentRegister :timetables="timetables"></TimetableComponentRegister>
      <p>
        <button class="usual-button back-home" onclick="location.href='./home'">
          <div>戻る</div>
        </button>
        <button class="unusual-button timetable-update" onclick="location.href='./timetableUpdate'">
          <div>時間割更新</div>
        </button>
      </p>
    </body>
  </default-layout>
</template>

<script lang="ts" setup>
import ModalBase from '~~/components/modal-base.vue'
import { format } from 'date-fns'
import { TimetableRegister } from '~~/types/response/timetablesRegisterResponse'
import { DAY_OF_WEEK } from '~~/util/constants'

const isShown = ref(false)

function onclick() {
  isShown.value = !isShown.value
}
const start = ref()
const end = ref()

function selectDate(e) {
  start.value = format(e[0], 'yyyy-MM-dd')
  end.value = format(e[1], 'yyyy-MM-dd')
  //カレンダーモーダルを閉じる
  isShown.value = false
}

const today = new Date()
console.log(today)

// import { TimetableComponentRegister } from '~~/.nuxt/components'
// import TimetableComponentRegister from '~~/components/timetable-component-register.vue'
/* 検証用オブジェクト */
const timetables: TimetableRegister[] = Object.entries(DAY_OF_WEEK).map(([_, value]) => ({
  dayOfWeek: value,
  lessons: [...Array(6)].map((_) => ({
    subject: '',
    teacher: '',
  })),
}))
</script>

<style lang="scss" scoped>
@import '../assets/scss/timetable.scss';

$background-color: #eaeaea;

input {
  margin-top: 40px;
  width: 224px;
  height: 40px;
  // padding-right: 160px;
}

.date-set {
  padding-left: 380px;
  font-size: 24px;
  margin-top: 16px;
}

.datetext {
  padding-left: 80px;
  font-size: 24px;
}

.home {
  color: #5160ae;
  font-size: 24px;
  margin-top: 42px;
}

.student-home {
  color: #5160ae;
  font-size: 18px;
}
.logout {
  color: #5160ae;
  font-size: 24px;
}

.back-home {
  color: #5160ae;
  font-size: 24px;
  position: fixed;
  left: 320px;
  top: 950px;
}
.timetable-update {
  color: white;
  font-size: 24px;
  position: fixed;
  left: 960px;
  top: 950px;
}

.start-end-date {
  color: #5160ae;
  font-size: 18px;
}

// カレンダーダイアログのscss
@import '@vuepic/vue-datepicker/src/VueDatePicker/style/main.scss';
</style>

<template>
  <default-layout page-name="教師用登録ページ">
    <div class="date-set">
      <button class="usual-button start-end-date" type="button" @click="onclick">
        <div class="font-size-m">開始日終了日選択</div>
      </button>
      <label class="datetext">{{ start }}~{{ end }}</label>
      <calendar-modal
        :is-shown="isShown"
        @update:value="selectDate"
        selection-type="range"
        @on-close="() => (isShown = false)"
      >
      </calendar-modal>
    </div>

    <p>
      <button class="usual-button home" type="button" @click="() => navigateTo('/home')">
        <div class="font-size-l">ホーム</div>
      </button>
    </p>

    <p>
      <button class="usual-button student-home" type="button" @click="open">
        <div class="font-size-m">生徒用画面確認</div>
      </button>
    </p>

    <p>
      <button class="usual-button logout" type="button" @click="commonLogout">
        <div class="font-size-l">ログアウト</div>
      </button>
    </p>

    <TimetableComponentRegister v-model:timetables="timetables"></TimetableComponentRegister>
    <p>
      <button class="usual-button back-home" type="button" @click="() => navigateTo('/home')">
        <div class="font-size-l">戻る</div>
      </button>
      <button class="unusual-button timetable-update" type="button" @click="useState">
        <div class="font-size-l">時間割更新</div>
      </button>
    </p>
  </default-layout>
</template>

<script lang="ts" setup>
import { format } from 'date-fns'
import { DAY_OF_WEEK } from '~~/util/constants'
import { useTimetables } from '~~/composables/useTimetables'
import { Lesson, Timetable } from '~~/types/response/timetablesAcquireResponse'
import { commonLogout } from '~~/util/logout'

const isShown = ref(false)

function onclick() {
  isShown.value = !isShown.value
}

function open() {
  window.open('/studentHome', '_blank', 'noreferrer')
}

const start = ref()
const end = ref()

function selectDate(e: Date[]) {
  start.value = format(e[0], 'yyyy-MM-dd')
  end.value = format(e[1], 'yyyy-MM-dd')
  //カレンダーモーダルを閉じる
  isShown.value = false
}

function useState() {
  useTimetables().lessons.value = timetables
    .map((timetable) =>
      (timetable.lessons ?? [])
        .map((lesson, index) => {
          return {
            subject: lesson.subject,
            teacher: lesson.teacher,
            period: index + 1,
            dayOfWeek: timetable.dayOfWeek,
          }
        })
        .filter((lesson) => lesson.subject.length || lesson.teacher.length)
    )
    .flat()
  console.log(useTimetables().lessons.value)
  useTimetables().time.value = { start: start.value, end: end.value }
  console.log(useTimetables().time.value)

  if (start.value == undefined || end.value == undefined) {
    alert('開始日終了日を選択してください')
  } else if (useTimetables().lessons.value.length === 0) {
    alert('授業を登録してください')
  } else {
    navigateTo('/timetableUpdate')
  }
}

const today = new Date()
console.log(today)

/* 検証用オブジェクト */
const timetables: Timetable[] = Object.entries(DAY_OF_WEEK).map<Timetable>(([_, value]) => ({
  dayOfWeek: value,
  isHoliday: false,
  isunavailable: false,
  date: '',
  lessons: [...Array(6)].map<Lesson>((_) => ({
    subject: '',
    teacher: '',
  })),
}))

definePageMeta({
  middleware: 'auth',
})
</script>

<style lang="scss" scoped>
input {
  margin-top: 40px;
  width: 224px;
  height: 40px;
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
  margin-top: 66px;
}

.back-home {
  position: absolute;
  left: 320px;
  top: 888px;
}
.timetable-update {
  position: absolute;
  left: 960px;
  top: 888px;
}

// カレンダーダイアログのscss
@import '@vuepic/vue-datepicker/src/VueDatePicker/style/main.scss';
</style>

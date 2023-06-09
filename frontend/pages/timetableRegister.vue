<template>
  <default-layout page-name="教師用時間割登録ページ">
    <div class="main">
      <div class="timetable-button-area">
        <button class="usual-button home font-size-l" type="button" @click="() => navigateTo('/home')">ホーム</button>

        <button class="usual-button student-home font-size-m" type="button" @click="open">生徒用画面確認</button>

        <button class="usual-button logout font-size-l" type="button" @click="commonLogout">ログアウト</button>
      </div>

      <div class="timetable-wrapper">
        <div class="date-set">
          <button class="usual-button start-end-date" type="button" @click="onclick">
            <div class="font-size-m">開始日終了日選択</div>
          </button>
          <label v-if="isDisplayableTerm" class="datetext">{{ start }}~{{ end }}</label>
          <calendar-modal
            :is-shown="isShown"
            @update:value="selectDate"
            selection-type="range"
            @on-close="() => (isShown = false)"
          >
          </calendar-modal>
        </div>
        <TimetableComponentRegister v-model:timetables="timetables"></TimetableComponentRegister>
        <div class="bottom">
          <div class="bottom-button-area">
            <button class="usual-button back-home" type="button" @click="() => navigateTo('/home')">
              <div class="font-size-l">戻る</div>
            </button>
            <button class="unusual-button timetable-update" type="button" @click="useState">
              <div class="font-size-l">時間割更新</div>
            </button>
          </div>
        </div>
      </div>
    </div>
  </default-layout>
</template>

<script lang="ts" setup>
import { format } from 'date-fns'
import { DAY_OF_WEEK } from '~~/util/constants'
import { useTimetables } from '~~/composables/useTimetables'
import { Lesson, Timetable } from '~~/types/response/timetablesAcquireResponse'
import { commonLogout } from '~~/util/logout'

definePageMeta({
  middleware: 'auth',
  title: 'T.T.L - 時間割登録画面',
})

const isShown = ref(false)

function onclick() {
  isShown.value = !isShown.value
}

/* 生徒用画面へ遷移 */
function open() {
  window.open('/studentHome', '_blank', 'noreferrer')
}

const start = ref()
const end = ref()

const isDisplayableTerm = ref(false)

function selectDate(e: Date[]) {
  start.value = format(e[0], 'yyyy-MM-dd')
  end.value = format(e[1], 'yyyy-MM-dd')
  isDisplayableTerm.value = true
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
            isClear: lesson.isClear,
          }
        })
        .filter((lesson) => (lesson.subject.length && lesson.teacher.length) || lesson.isClear)
    )
    .flat()
  useTimetables().time.value = { start: start.value, end: end.value }
  if (start.value == undefined || end.value == undefined) {
    alert('開始日終了日を選択してください')
  } else if (useTimetables().lessons.value.length === 0) {
    alert('授業を登録してください')
  } else {
    navigateTo('/timetableUpdate')
  }
}

/* 初期オブジェクト */
const timetables: Timetable[] = Object.entries(DAY_OF_WEEK).map<Timetable>(([_, value]) => ({
  dayOfWeek: value,
  isHoliday: false,
  isunavailable: false,
  date: '',
  lessons: [...Array(6)].map<Lesson>((_) => ({
    subject: '',
    teacher: '',
    isClear: false,
  })),
}))
</script>

<style lang="scss" scoped>
input {
  margin-top: 40px;
  width: 224px;
  height: 40px;
}

.date-set {
  margin-left: 180px;
  font-size: 24px;
  margin-top: 16px;
}

.datetext {
  padding-left: 80px;
  font-size: 24px;
}

.main {
  display: flex;
  height: calc(100vh - 100px);
  margin-bottom: min(10px, 5%);
}

.register {
  margin-top: 100px;
}

.timetable-button-area {
  margin-top: 200px;
  padding: auto;
  width: min(20%, 250px);
  display: flex;
  flex-direction: column;
  text-align: center;
}

.bottom {
  width: 100%;
  padding: 0 80px;
}
.bottom-button-area {
  display: flex;
  justify-content: space-between;
}

// カレンダーダイアログのscss
@import '@vuepic/vue-datepicker/src/VueDatePicker/style/main.scss';
</style>

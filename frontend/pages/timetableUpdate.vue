<template>
  <default-layout page-name="教師用更新ページ">
    <!-- html記述場所 -->
    <div class="main">
      <!--ボタン-->
      <div class="timetable-button-area">
        <button class="left-button button-font-color usual-button font-size-l" @click="goToHome">ホーム</button>
        <button class="left-button button-font-color usual-button font-size-m" @click="goToStudentPage">
          生徒用画面確認
        </button>
        <button class="left-button button-font-color usual-button font-size-l" @click="commonLogout()">
          ログアウト
        </button>
      </div>
      <div class="timetable-wrapper">
        <!--時間表示場所-->
        <div class="time-area">
          <div class="time-area-text">
            <div class="font-size-xl">この時間割を登録しますか？</div>
            <div class="time-area-text-margin font-size-l">{{ time?.start }} ~ {{ time?.end }}</div>
          </div>
        </div>
        <!--時間割エリア-->
        <div class="right-area">
          <table class="timetable update">
            <tbody>
              <!--時間割-->
              <!--最初の列 空白と時間割の時限を置く-->
              <tr>
                <th class="dayOfWeek-head horizontal-writing"></th>
                <!--時限表示ループ-->
                <template v-for="periodNumber of periodCount" :key="periodNumber">
                  <TimetablePeriod :period="periodNumber"></TimetablePeriod>
                </template>
              </tr>
              <template v-for="dayOfWeek in dayOfWeekCount" :key="dayOfWeek">
                <tr>
                  <TimetableDayOfWeek :day-of-week="dayOfWeekChangeString(dayOfWeek)" />
                  <template v-for="period in periodCount" :key="period">
                    <template v-if="lessonExist(period, dayOfWeek)">
                      <!--データがある時-->
                      <TimetableLesson
                        :is-holiday="false"
                        :subject="getSubject(period, dayOfWeek)"
                        :teacher-name="getTeacher(period, dayOfWeek)"
                        :is-unavailable="false"
                      />
                    </template>

                    <template v-else>
                      <!--データがないとき-->
                      <TimetableLesson :is-holiday="false" :is-unavailable="false" />
                    </template>
                  </template>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
        <div class="bottom">
          <div class="bottom-button-area">
            <div class="bottom-left-button">
              <button
                class="usual-button button-font-color font-size-l"
                @click="() => navigateTo('/timetableRegister')"
              >
                <div>戻る</div>
              </button>
            </div>
            <div class="bottom-right-button">
              <button class="important-button important-button-font-color font-size-l" @click="registerTimetables">
                <div>更新確定</div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </default-layout>
</template>

<script lang="ts" setup>
import { useTimetables } from '~~/composables/useTimetables'
import { messagesResponse } from '~~/types/response/messagesResponse'
import { commonLogout } from '~~/util/logout'

definePageMeta({
  middleware: 'auth',
  title: 'T.T.L - 時間割更新画面',
})

/* 固定の変数　*/
const periodCount: number = 6
const dayOfWeekCount = [1, 2, 3, 4, 5, 6, 0]

let subjectData: string = ''
let teacherData: string = ''

const config = useRuntimeConfig()

const { time, lessons } = useTimetables()

const timetableInfo = lessons.value

useTimetablesExists()

function useTimetablesExists() {
  if (time.value == null || timetableInfo == null) {
    navigateTo({ path: '/timetableRegister' })
  }
}

//POST用データ
const timetablesData = {
  time: time.value,
  lessons: lessons.value,
}

//ホーム画面遷移
function goToHome() {
  navigateTo({ path: '/home' })
}

//生徒用画面遷移
function goToStudentPage() {
  window.open('/studentHome', '_blank', 'noreferrer')
}

async function registerTimetables() {
  //登録処理
  try {
    const response = await $fetch<messagesResponse>('/api/timetablesCreate/', {
      method: 'POST',
      body: timetablesData,
      baseURL: config.public.apiUrl,
    })

    if (response.messages[0] === 'success') {
      // response:success

      //useTimetables削除
      useTimetables().clear()

      alert('登録に成功しました')

      navigateTo({ path: '/home' })
      return
    } else if (response.messages[0] === 'failure') {
      // response:failure
      alert('登録に失敗しました')
    } else {
      //validationerror
      alert(response.messages.slice(1).join('\n'))
    }
  } catch (e) {
    console.error(e)
  }
}

/* 曜日の文字を返却 */
function dayOfWeekChangeString(dayOfWeek: number) {
  switch (dayOfWeek) {
    case 0:
      return '日'
    case 1:
      return '月'
    case 2:
      return '火'
    case 3:
      return '水'
    case 4:
      return '木'
    case 5:
      return '金'
    case 6:
      return '土'
  }
  return ''
}
//存在するか調べる
function lessonExist(periodNumber: number, dayOfWeekNumber: number) {
  return timetableInfo
    .filter(({ period }) => period === periodNumber)
    .some(({ dayOfWeek }) => dayOfWeek === dayOfWeekNumber)
}

//教科名取得
function getSubject(periodNumber: number, dayOfWeekNumber: number) {
  subjectData = String(
    timetableInfo.filter(({ period }) => period === periodNumber).find(({ dayOfWeek }) => dayOfWeek === dayOfWeekNumber)
      ?.subject
  )
  return subjectData
}
//教師名取得
function getTeacher(periodNumber: number, dayOfWeekNumber: number) {
  teacherData = String(
    timetableInfo.filter(({ period }) => period === periodNumber).find(({ dayOfWeek }) => dayOfWeek === dayOfWeekNumber)
      ?.teacher
  )
  return teacherData
}
</script>

<style scoped lang="scss">
@import '../assets/scss/timetable.scss';

.timetable {
  width: 1120px;
  height: 580px;
}

.update {
  margin-left: 0px;
}
.time-area {
  height: 150px;
}
.time-area-text {
  text-align: center;
  margin: 30px 0;
}
.time-area-text-margin {
  margin: 30px;
}
/* メイン */
.main {
  display: flex;
  margin-bottom: min(10px, 5%);
}
.right_area {
  display: flex;
  margin-left: 24px;
}

.timetable-button-area {
  margin-top: 200px;
  padding: auto;
  width: min(20%, 250px);
  display: flex;
  flex-direction: column;
  text-align: center;
}

/*下部 */
.bottom {
  width: 100%;
  padding: 0 80px;
}
.button-font-color {
  color: #5160ae;
}
.bottom-button-area {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
}

.important-button {
  background-color: #5160ae;
  width: 160px;
  height: 60px;
  border-radius: 10px;
  border: solid 3px #5160ae;
  margin-top: 24px;
  margin-left: 20px;
}
.important-button-font-color {
  color: #ffffff;
}
</style>

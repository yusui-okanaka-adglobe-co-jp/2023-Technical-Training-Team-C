<template>
  <default-layout page-name="教師用ページ">
    <section class="container">
      <!-- html記述場所 -->
      <div class="main">
        <!--ボタン-->
        <div class="timetable-button-area">
          <button class="button-font-color usual-button font-size-l" @click="getThisWeekTimetables">
            今週の時間割
          </button>
          <button class="button-font-color usual-button font-size-l" @click="openCalendarModal">日付選択</button>
          <button class="button-font-color usual-button font-size-l" @click="goToRegisterPage">時間割登録</button>
          <button class="button-font-color usual-button font-size-m" @click="goToStudentPage">生徒用画面確認</button>
          <button class="button-font-color usual-button font-size-l" type="button" @click="commonLogout">
            ログアウト
          </button>
        </div>
        <calendar-modal :is-shown="isShown" @update:value="selectDate" @on-close="() => (isShown = false)">
        </calendar-modal>
        <div class="timetable-wrapper">
          <!--三角ボタン-->
          <div class="triangle-button-area">
            <div class="triangle-button">
              <!--先週-->
              <button
                class="triangle-left"
                :disabled="displayLeftButton()"
                :class="{ oldest: displayDateOldestDate() }"
                @click="getLastWeekTimetable()"
              ></button>
              <!--来週-->
              <button
                class="triangle-right"
                :disabled="displayRightButton()"
                :class="{ latest: displayDateLatestDate() }"
                @click="getNextWeekTimetable()"
              ></button>
            </div>
          </div>

          <!--時間割-->

          <div v-show="loadingDisplay">
            <TimetableComponent :timetables="timetables"></TimetableComponent>
          </div>
        </div>
      </div>
    </section>
  </default-layout>
</template>

<script lang="ts" setup>
// 認証用middleware
definePageMeta({
  middleware: 'auth',
})
import { Timetable } from '~~/types/response/timetablesAcquireResponse'
import { format, parse } from 'date-fns'
import { commonLogout } from '~~/util/logout'

const config = useRuntimeConfig()
const route = useRoute()
const timetables = ref<Timetable[]>([])
//calendar用
const isShown = ref(false)
const isRendering = ref(true)

//createdのときに行う処理
const view = ref()
const loadingDisplay = ref(false)
let displayDate: Date
const oldestDate = parse('20150101', 'yyyyMMdd', new Date())
const nextYear = String(new Date().getFullYear() + 1)
const latestString = nextYear + '1225'
const latestDate = parse(latestString, 'yyyyMMdd', new Date())

await getTimetableData()

displayToggle()
//以下function

//データ取得が完了すれば時間割を表示する
function displayToggle() {
  loadingDisplay.value = !loadingDisplay.value
}

onMounted(() => {
  isRendering.value = false
})

//前週ボタン表示
function displayLeftButton() {
  return oldestDate >= displayDate || isRendering.value
}
function displayDateOldestDate() {
  return oldestDate >= displayDate
}
//次週ボタン表示
function displayRightButton() {
  return latestDate <= displayDate || isRendering.value
}

function displayDateLatestDate() {
  return latestDate <= displayDate
}

//前週ボタン押下時
function getLastWeekTimetable() {
  if (oldestDate <= displayDate) {
    displayDate.setDate(displayDate.getDate() - 7)
    const lastWeekDate = format(displayDate, 'yyyy-MM-dd')
    navigateTo({
      path: '/home',
      query: {
        date: lastWeekDate,
      },
    })
  } else {
    alert('2014年の時間割は表示できません')
  }
}
//次週ボタン押下時
function getNextWeekTimetable() {
  if (latestDate >= displayDate) {
    displayDate.setDate(displayDate.getDate() + 7)
    const nextWeekDate = format(displayDate, 'yyyy-MM-dd')
    navigateTo({
      path: '/home',
      query: {
        date: nextWeekDate,
      },
    })
  } else {
    alert('再来年の時間割は表示できません')
  }
}
//APIから時間割取得
async function getTimetableData() {
  //クエリなしなら今週表示
  if (route.query.date == null) {
    view.value = getMonday(new Date())
  } else {
    //渡されたクエリを一度月曜判定入れる
    view.value = getMonday(parse(String(route.query.date), 'yyyy-MM-dd', new Date()))
    //月曜じゃなかったらURL変更、再度読み込み
    if (!(view.value === String(route.query.date))) {
      navigateTo({
        path: '/home',
        query: {
          date: view.value,
        },
      })
      return
    }
  }
  displayDate = parse(view.value, 'yyyy-MM-dd', new Date())
  try {
    const { data: response } = await useFetch<Timetable[]>('/api/timetablesAcquire/', {
      baseURL: config.public.apiUrl,
      query: { date: view.value },
    })
    isRendering.value = false
    if (response.value == null) {
      return
    }
    //クエリの日付と渡されている日付が同じか確認
    if (response.value[0].date !== view.value) {
      navigateTo({
        path: '/home',
        query: {
          date: response.value[0].date,
        },
      })
    }
    if (response.value != null) {
      timetables.value = response.value
    }
  } catch (e) {
    console.error(e)
  }
}

//今週の時間割表示
function getThisWeekTimetables() {
  let date = new Date()
  const dateMonday: string = getMonday(date)
  navigateTo({
    path: '/home',
    query: {
      date: dateMonday,
    },
  })
}
//日付選択
function openCalendarModal() {
  isShown.value = !isShown.value
}
//日付選択後の処理
function selectDate(e: String) {
  view.value = e

  //カレンダーモーダルを閉じる
  isShown.value = false

  return navigateTo({
    path: '/home',
    query: {
      date: format(view.value, 'yyyy-MM-dd'),
    },
  })
}

//登録画面遷移
function goToRegisterPage() {
  navigateTo({ path: '/timetableRegister' })
}

//生徒用画面遷移
function goToStudentPage() {
  window.open('/studentHome', '_blank', 'noreferrer')
}

//与えられた日付から月曜日を求める
function getMonday(date: Date) {
  while (true) {
    if (date.getDay() == 1) break
    date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - 1)
  }
  const thisWeekMonday = format(date, 'yyyy-MM-dd')
  return thisWeekMonday
}

//パラメータの監視。変化があればリロード
watch(
  () => route.query,
  () => {
    getTimetableData()
    isRendering.value = true
  }
)
</script>

<style scoped lang="scss">
.container {
  margin: 15px min(10%, 20px) 15px 0;
}
/* 三角関連 */
.triangle-button-area {
  height: 120px;
  padding-top: 48px;
}
.triangle-button {
  width: 160px;
  height: 56px;
  margin-left: auto;
}

.triangle-left {
  background: transparent;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 25px 48px 25px 0;
  border-color: transparent #5160ae transparent transparent;
  position: absolute;
}
.triangle-right {
  background: transparent;
  margin-left: 104px;
  margin-right: 0;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 25px 0 25px 48px;
  border-color: transparent transparent transparent #5160ae;
  position: absolute;
}

.triangle-left:hover,
.triangle-right:hover {
  filter: brightness(1.1);
}
.oldest {
  border-color: transparent gray transparent transparent;
  opacity: 0.3;
  filter: brightness(0.8);
}
.latest {
  border-color: transparent transparent transparent gray;
  opacity: 0.3;
  filter: brightness(0.8);
}
/* 下部 */
.main {
  display: flex;
}
.timetable-wrapper {
  margin-bottom: min(80px, 10%);
}
button {
  margin-bottom: 24px;
}
.timetable-button-area {
  margin-top: 120px;
  padding: auto;
  width: min(20%, 250px);
  display: flex;
  flex-direction: column;
  text-align: center;
}
//遷移ボタン関連
.button-font-color {
  color: #5160ae;
}
</style>

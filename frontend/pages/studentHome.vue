<template>
  <default-layout page-name="">
    <section class="main">
      <!-- html記述場所 -->
      <!--ボタン-->
      <div class="button-wrapper">
        <button class="font-size-xs button-wrapper__button" @click="getThisWeekTimetables">今週の時間割</button>
        <button class="font-size-xs button-wrapper__button" @click="openCarendar">日付選択</button>
        <calendar-modal :is-shown="isShown" @update:value="selectDate" @on-close="() => (isShown = false)">
        </calendar-modal>
      </div>
      <!--三角ボタン-->
      <div class="triangle-wrapper">
        <div class="triangle-wrapper__inner">
          <!--先週-->
          <button
            class="triangle-wrapper__inner__left"
            :disabled="displayLeftButton()"
            @click="getLastWeekTimetable()"
          ></button>
          <!--来週-->
          <button
            class="triangle-wrapper__inner__right"
            :disabled="displayRightButton()"
            @click="getNextWeekTimetable()"
          ></button>
        </div>
      </div>
      <!--時間割-->
      <div v-show="loadingDisplay" class="table-wrapper">
        <TimetableComponent :timetables="timetables"></TimetableComponent>
      </div>
    </section>
  </default-layout>
</template>

<script lang="ts" setup>
import { Timetable } from '~~/types/response/timetablesAcquireResponse'
import { format, parse } from 'date-fns'

const route = useRoute()
const timetables = ref<Timetable[]>([])

//createdのときに行う処理
const view = ref()
const calendarView = view
const loadingDisplay = ref(false)
let displayDate: Date
const oldestDate = parse('20150101', 'yyyyMMdd', new Date())
const nextYear = String(new Date().getFullYear() + 1)
const latestString = nextYear + '1225'
const latestDate = parse(latestString, 'yyyyMMdd', new Date())

await getTimetableData()

displayToggle()
//以下function

// カレンダーモーダル
const isShown = ref(false)

function openCarendar() {
  isShown.value = !isShown.value
}

calendarView.value = null

function selectDate(e: any) {
  calendarView.value = e

  //カレンダーモーダルを閉じる
  isShown.value = false

  return navigateTo({
    path: '/studentHome',
    query: {
      date: format(calendarView.value, 'yyyy-MM-dd'),
    },
  })
}

//データ取得が完了すれば時間割を表示する
function displayToggle() {
  loadingDisplay.value = !loadingDisplay.value
}

//前週ボタン表示
function displayLeftButton() {
  return oldestDate >= displayDate
}
//次週ボタン表示
function displayRightButton() {
  return latestDate <= displayDate
}

//前週ボタン押下時
function getLastWeekTimetable() {
  if (oldestDate <= displayDate) {
    displayDate.setDate(displayDate.getDate() - 7)
    const lastWeekDate = format(displayDate, 'yyyy-MM-dd')
    navigateTo({
      path: '/studentHome',
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
      path: '/studentHome',
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
        path: '/studentHome',
        query: {
          date: view.value,
        },
      })
      return
    }
  }
  displayDate = parse(view.value, 'yyyy-MM-dd', new Date())
  const config = useRuntimeConfig()
  try {
    const { data: response } = await useFetch<Timetable[]>('/api/timetablesAcquire/', {
      baseURL: config.public.apiUrl,
      query: { date: view.value },
    })
    //クエリの日付と渡されている日付が同じか確認
    if (response.value?.[0].date !== view.value) {
      navigateTo({
        path: '/studentHome',
        query: {
          date: response.value?.[0].date,
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
    path: '/studentHome',
    query: {
      date: dateMonday,
    },
  })
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
  }
)
</script>

<style scoped lang="scss">
.main {
  margin: 0 auto;
}
// 時間割テーブル
.table-wrapper {
  overflow-x: auto;
  margin-top: 16px;
}

// 三角ボタン
.triangle-wrapper__inner {
  width: 64px;
  height: 32px;
  margin-left: auto;

  &__left {
    background: transparent;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 25px 48px 25px 0;
    border-color: transparent #5160ae transparent transparent;
    position: absolute;
  }

  &__right {
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

  &__left:hover,
  &__right:hover {
    filter: brightness(1.1);
  }

  &__left:disabled {
    border-color: transparent gray transparent transparent;
    opacity: 0.3;
    filter: brightness(0.8);
  }

  &__right:disabled {
    border-color: transparent transparent transparent gray;
    opacity: 0.3;
    filter: brightness(0.8);
  }
}

// PC用スタイル
@media screen and (min-width: 768px) {
  // 時間割テーブル
  .timetable {
    margin: 16px auto;
  }

  // ボタン
  .button-wrapper {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 40px;

    &__button {
      color: #5160ae;
      width: 160px;
      height: 60px;
      font-size: 24px;
      margin-left: 24px;
      margin-right: 24px;
      background-color: white;
      border-radius: 10px;
      border: solid 3px #5160ae;
    }
  }

  // 三角ボタン
  .triangle-wrapper {
    max-width: 1200px;
    width: 100%;
    margin: 0 auto;

    &__inner {
      width: 152px;
      height: 32px;
      margin-left: auto;
    }
  }
}

// モバイル用スタイル
@media only screen and (max-width: 767px) {
  .main {
    width: 100%;
  }
  // ボタン
  .button-wrapper {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 40px;
    margin-bottom: 16px;

    &__button {
      color: #5160ae;
      width: 90px;
      height: auto;
      margin-left: 8px;
      margin-right: 8px;
      margin-bottom: 8px;
      background-color: white;
      border-radius: 10px;
      border: solid 3px #5160ae;
    }
  }
  // 三角ボタン
  .triangle-wrapper {
    height: 24px;
    padding-top: 0px;
    margin: 0 auto;
    max-width: 360px;
    width: 100%;
    margin-bottom: 16px;

    &__inner {
      width: 64px;
      height: 32px;
      margin-left: auto;

      &__left {
        border-width: 12px 24px 12px 0;
      }

      &__right {
        margin-left: 40px;
        border-width: 12px 0 12px 24px;
      }
    }
  }
}
</style>

<template>
  <default-layout page-name="教師用ページ">
    <section class="container">
      <!-- html記述場所 -->
      <!--三角ボタン-->
      <div class="triangle-button-area">
        <div class="triangle-button">
          <!--先週-->
          <button class="triangle-left" :disabled="displayLeftButton()" @click="getLastWeekTimetable()"></button>
          <!--来週-->
          <button class="triangle-right" :disabled="displayRightButton()" @click="getNextWeekTimetable()"></button>
        </div>
      </div>
      <div class="main">
        <!--ボタン-->
        <div class="timetable-button-area">
          <button @click="getThisWeekTimetables">今週の時間割</button>
          <button>日付選択</button>
          <button @click="goToRegisterPage">時間割登録</button>
          <button @click="goToStudentPage">生徒用画面確認</button>
          <button @click="logout">ログアウト</button>
        </div>
        <!--時間割-->
        <div>
          <div v-show="loadingDisplay">
            <TimetableComponent :timetables="timetables"></TimetableComponent>
          </div>
        </div>
      </div>
    </section>
  </default-layout>
</template>

<script lang="ts" setup>
import { Timetable } from '~~/types/response/timetablesAcquireResponse'
import { format, parse } from 'date-fns'

const route = useRoute()
const timetables = ref<Timetable[]>([])

/* 検証用オブジェクト */
const timetables2: Timetable[] = [
  {
    date: '2023-04-17',
    dayOfWeek: 1,
    isHoliday: false,
    lessons: [
      {
        subject: '国語',
        teacher: '佐藤',
      },
      {
        subject: '数学',
        teacher: '鈴木鈴木',
      },
      {
        subject: '理科',
        teacher: '高橋高橋高橋',
      },
      {
        subject: '社会',
        teacher: '田中田中田中田中',
      },
      {
        subject: '音楽',
        teacher: '伊藤伊藤伊藤伊藤伊藤',
      },
      {
        subject: '道徳',
        teacher: '中村',
      },
    ],
  },
  {
    date: '2023-04-18',
    dayOfWeek: 2,
    isHoliday: false,
    lessons: [
      {
        subject: '数学数学数学',
        teacher: '鈴木',
      },
      {
        subject: '国語国語国語',
        teacher: '佐藤佐藤',
      },
      {
        subject: '理科理科理科',
        teacher: '高橋高橋高橋',
      },
      {
        subject: '社会社会社会',
        teacher: '田中田中田中田中',
      },
      {
        subject: '体育体育体育',
        teacher: '大林大林大林大林大林',
      },
      {
        subject: '',
        teacher: '',
      },
    ],
  },
  {
    date: '2023-04-19',
    dayOfWeek: 3,
    isHoliday: false,
    lessons: [
      {
        subject: '国語国語国語国語国語',
        teacher: '佐藤',
      },
      {
        subject: '数学数学数学数学数学',
        teacher: '鈴木鈴木',
      },
      {
        subject: '理科理科理科理科理科',
        teacher: '高橋高橋高橋',
      },
      {
        subject: '社会社会社会社会社会',
        teacher: '田中田中田中田中',
      },
      {
        subject: '音楽音楽音楽音楽音楽',
        teacher: '伊藤伊藤伊藤伊藤伊藤',
      },
      {
        subject: '',
        teacher: '',
      },
    ],
  },
  {
    date: '2023-04-20',
    dayOfWeek: 4,
    isHoliday: true,
    holidayTitle: '○○の日',
  },
  {
    date: '2023-04-21',
    dayOfWeek: 5,
    isHoliday: true,
    holidayTitle: '○○○○○の日',
  },
  {
    date: '2023-04-22',
    dayOfWeek: 6,
    isHoliday: true,

    holidayTitle: '天皇誕生日 振替休日',
  },
  {
    date: '2023-04-23',
    dayOfWeek: 0,
    isHoliday: false,
    lessons: [
      {
        subject: '国語',
        teacher: '佐藤',
      },
      {
        subject: '数学',
        teacher: '鈴木',
      },
      {
        subject: '理科',
        teacher: '高橋',
      },
      {
        subject: '社会',
        teacher: '田中',
      },
      {
        subject: '音楽',
        teacher: '伊藤',
      },
      {
        subject: '道徳',
        teacher: '斎藤',
      },
    ],
  },
]

//createdのときに行う処理
const view = ref()
const loadingDisplay = ref(false)
let displayDate: Date
const oldestDate = parse('20150104', 'yyyyMMdd', new Date())
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
  const { data: response } = await useFetch<Timetable[]>(
    ' http://localhost:8000/api/timetablesAcquire?date=' + view.value,
    {}
  )

  if (response.value != null) {
    timetables.value = response.value
  }
}

//登録画面遷移
function goToRegisterPage() {
  navigateTo({ path: '/timetableRegister' })
}

//生徒用画面遷移
function goToStudentPage() {
  window.open('/studentHome', '_blank', 'noreferrer')
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

//与えられた日付から月曜日を求める
function getMonday(date: Date) {
  while (true) {
    if (date.getDay() == 1) break
    date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - 1)
  }
  const thisWeekMonday = format(date, 'yyyy-MM-dd')
  return thisWeekMonday
}

//ログアウト処理 ログインAPIが出来次第記述
function logout() {}

//パラメータの監視。変化があればリロード
watch(
  () => route.query,
  () => {
    location.reload()
  }
)
</script>

<style scoped lang="scss">
.container {
  margin: 0 36px 0 0;
}
/* 三角関連 */
.triangle-button-area {
  height: 120px;
  padding-top: 48px;
  display: flex;
  justify-content: flex-end;
}
.triangle-button {
  width: 160px;
  height: 56px;
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
.triangle-left:disabled {
  border-color: transparent gray transparent transparent;
  opacity: 0.3;
  filter: brightness(0.8);
}
.triangle-right:disabled {
  border-color: transparent transparent transparent gray;
  opacity: 0.3;
  filter: brightness(0.8);
}
/* 下部 */
.main {
  display: flex;
}
button {
  margin-bottom: 24px;
}
.timetable-button-area {
  // width: 204px;
  width: 14%;
  display: flex;
  flex-direction: column;
  text-align: center;
}
</style>

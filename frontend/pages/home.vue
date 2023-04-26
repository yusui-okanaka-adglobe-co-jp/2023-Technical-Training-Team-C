<template>
  <default-layout page-name="教師用ページ">
    <div :class="timeconsole()"></div>
    <section class="container">
      <!-- html記述場所 -->
      <!--三角ボタン-->
      <div class="triangle-button-area">
        <div class="triangle-button">
          <!--先週-->
          <button class="triangle-left" href="#"></button>
          <!--来週-->
          <a class="triangle-right" href="#"></a>
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
          <TimetableComponent :timetables="timetables"></TimetableComponent>
        </div>
      </div>
    </section>
  </default-layout>
</template>

<script lang="ts" setup>
import { Timetable, Lesson } from '~~/types/response/timetablesAcquireResponse'
import { format } from 'date-fns'
import { onMounted } from 'vue'

const route = useRoute()
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

//APIから時間割取得
console.log(' http://localhost:8000/api/timetablesAcquire?date=' + route.query.date)

const { data: response } = useFetch<Timetable[]>(
  ' http://localhost:8000/api/timetablesAcquire?date=' + route.query.date,
  {}
)

const timetables = ref<Timetable[]>([])

if (response.value != null) {
  timetables.value = response.value
}

//登録画面遷移
function goToRegisterPage() {
  navigateTo({ path: '/timetableRegister' })
}

//生徒用画面遷移
function goToStudentPage() {
  window.open('/studentHome', '_blank')
}

//今週の時間割表示
function getThisWeekTimetables() {
  //月曜日を求める
  let date = new Date()
  while (true) {
    if (date.getDay() == 1) break
    date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - 1)
  }
  const dateMonday = format(date, 'yyyyMMdd')
  navigateTo({
    path: '/home',
    query: {
      date: 2021,
    },
  })
}

//ログアウト
function logout() {}

function timeconsole() {
  console.log('表示')
}
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
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 25px 48px 25px 0;
  border-color: transparent #5160ae transparent transparent;
  position: absolute;
}
.triangle-right {
  // margin: 30px 0 0px 90px;
  margin-left: 104px;
  margin-right: 0;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 21px 0 21px 48px;
  border-color: transparent transparent transparent #5160ae;
  position: absolute;
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

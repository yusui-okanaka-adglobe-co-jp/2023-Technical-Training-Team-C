<template>
  <default-layout page-name="教師用更新ページ">
    <!-- html記述場所 -->
    <!--時間表示場所-->
    <div class="time-area">
      <div class="time-area-text">
        <div class="font-size-xl">この時間割を登録しますか？</div>
        <div class="time-area-text-margin font-size-l">{{ time.start }} ~ {{ time.end }}</div>
      </div>
    </div>
    <div class="main">
      <!--ボタン-->
      <div class="timetable-button-area">
        <button class="left-button button-font-color usual-button font-size-l" @click="goToHome">ホーム</button>
        <button class="left-button button-font-color usual-button font-size-m" @click="goToStudentPage">
          生徒用画面確認
        </button>
        <button class="left-button button-font-color usual-button font-size-l" @click="logout">ログアウト</button>
      </div>
      <!--時間割-->
      <div class="right-area">
        <!-- <div v-show="loadingDisplay"> -->
        <table class="timetable-update">
          <!-- <th class="vertical-head horizontal-writing"></th> -->
          <!-- <th> -->
          <!--時限-->
          <!-- <template v-for="periodNumber of blankCell" :key="periodNumber">
                <TimetablePeriod :period="periodNumber"></TimetablePeriod>
              </template> -->
          <!-- 曜日のループ -->
          <!-- </th> -->

          <!--時間割-->
          <!-- <template v-for="period in periodCount" :key="period"> -->
          <template v-for="dayOfWeek in dayOfWeekCount" :key="dayOfWeek">
            <tr>
              <TimetableDayOfWeek :day-of-week="dayOfWeekChangeString(dow[dayOfWeek - 1])"></TimetableDayOfWeek>
              <template v-for="period in periodCount" :key="period">
                <template v-if="lessonExist(period, dayOfWeek)">
                  <!--データある時-->
                  <TimetableLesson
                    :is-holiday="false"
                    :subject="getSubject(period, dayOfWeek)"
                    :teacher-name="getTeacher(period, dayOfWeek)"
                  />
                </template>

                <template v-else>
                  <TimetableLesson :is-holiday="false" />
                  <!--データないとき-->
                </template>
              </template>
            </tr>
          </template>
        </table>

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
              <button class="usual-button button-font-color font-size-l">
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
import { Timetable } from '~~/types/response/timetablesAcquireResponse'
import { format, parse } from 'date-fns'

/* 6回回す用　*/
const blankCell = 6

const periodCount: number = 6
const dayOfWeekCount = 7

let subjectData: string = ''
let teacherData: string = ''

const dow = [1, 2, 3, 4, 5, 6, 0]

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
const lessons = [
  {
    subject: '数学',
    teacher: '佐々木XXX',
    dayOfWeek: 1,
    period: 2,
  },
  {
    subject: '家庭科',
    teacher: '岩崎XXX',
    dayOfWeek: 1,
    period: 5,
  },
  {
    subject: '音楽',
    teacher: '青木XXX',
    dayOfWeek: 4,
    period: 5,
  },
]
const time = {
  start: '2023-04-01',
  end: '2023-07-31',
}

function goToHome() {
  navigateTo({ path: '/home' })
}

//生徒用画面遷移
function goToStudentPage() {
  window.open('/studentHome', '_blank', 'noreferrer')
}

//ログアウト処理 ログインAPIが出来次第記述
function logout() {}

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
  return lessons.filter(({ period }) => period === periodNumber).some(({ dayOfWeek }) => dayOfWeek === dayOfWeekNumber)
}

//教科名取得
function getSubject(periodNumber: number, dayOfWeekNumber: number) {
  subjectData = String(
    lessons.filter(({ period }) => period === periodNumber).find(({ dayOfWeek }) => dayOfWeek === dayOfWeekNumber)
      ?.subject
  )
  return subjectData
}
//教師名取得
function getTeacher(periodNumber: number, dayOfWeekNumber: number) {
  teacherData = String(
    lessons.filter(({ period }) => period === periodNumber).find(({ dayOfWeek }) => dayOfWeek === dayOfWeekNumber)
      ?.teacher
  )
  return teacherData
}
</script>

<style scoped lang="scss">
@import '../assets/scss/timetable.scss';
.timetable-update {
  writing-mode: vertical-lr;
  border-collapse: collapse;
  table-layout: fixed;

  background-color: #ffffff;
  box-shadow: 0 0 0 1px #333 inset;
}
.time-area {
  height: 180px;
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
}
.right_area {
  display: flex;
}
.left-button {
  margin-left: 24px;
  margin-bottom: 24px;
}
.timetable-button-area {
  width: 14%;
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
  position: relative;
}
.bottom-left-button {
  position: absolute;
  left: 24px;
}
.bottom-right-button {
  position: absolute;
  right: 24px;
}
</style>

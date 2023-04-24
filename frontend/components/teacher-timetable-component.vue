<template>
  <table>
    <!--最初の列 空白と時間割の時限を置く-->
    <tr>
      <th class="vertical-head"></th>
      <th class="dayOfWeek-head"></th>
      <!--時限表示ループ-->
      <template v-for="periodNumber of 6" :key="periodNumber">
        <TimetablePeriod :period="periodNumber"></TimetablePeriod>
      </template>
    </tr>
    <!--配列をループ-->
    <template v-for="timetable in timetables" :key="timetable">
      <tr>
        <!--祝日フラグで分岐-->
        <template v-if="!timetable.isHoliday">
          <!--祝日以外処理-->
          <TimetableDate
            :isHoliday="timetable.isHoliday"
            :day-of-week="timetable.dayOfWeek"
            :date="dateFormat(timetable.date)"
          >
          </TimetableDate>
          <TimetableDayOfWeek :dayOfWeek="dayOfWeekChangeString(timetable.dayOfWeek)"></TimetableDayOfWeek>
          <!--日曜判定-->
          <template v-if="!(timetable.dayOfWeek === 0)">
            <!--科目/教師のループ-->
            <template v-for="lessons in timetable.lessons" :key="lessons">
              <TimetableLesson
                :isHoliday="timetable.isHoliday"
                :subject="lessons.subject"
                :teacher-name="lessons.teacher"
              >
              </TimetableLesson>
            </template>
          </template>
          <!--日曜の処理-->
          <template v-else>
            <template v-for="lessons in timetable.lessons" :key="lessons">
              <TimetableLesson :isHoliday="true" :subject="lessons.subject" :teacher-name="lessons.teacher">
              </TimetableLesson>
            </template>
          </template>
        </template>
        <template v-else>
          <!--祝日処理-->
          <TimetableDate
            :isHoliday="timetable.isHoliday"
            :date="dateFormat(timetable.date)"
            :holiday-title="timetable.holidayTitle"
            :day-of-week="timetable.dayOfWeek"
          >
          </TimetableDate>
          <TimetableDayOfWeek :dayOfWeek="dayOfWeekChangeString(timetable.dayOfWeek)"></TimetableDayOfWeek>
          <!--6回ループさせる-->
          <template v-for="holidayCell of 6" :key="holidayCell">
            <TimetableLesson :isHoliday="timetable.isHoliday"></TimetableLesson>
          </template>
        </template>
      </tr>
    </template>
  </table>
</template>

<script lang="ts" setup>
import { ITimetable } from '~~/types/response/timetablesAcquireResponse'
import { format } from 'date-fns'

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

/* dateのフォーマット整える */
function dateFormat(date: string) {
  return format(new Date(date), 'M/d')
}

/* 検証用オブジェクト */
const timetables: ITimetable[] = [
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
</script>

<style lang="scss" vscoped>
table {
  writing-mode: vertical-lr;
  border-collapse: collapse;
  table-layout: fixed;
  width: 1200px;
  height: 660px;
  background-color: #ffffff;
  box-shadow: 0 0 0 1px #333 inset;
}
td,
th,
tr {
  box-shadow: 0 0 0 1px #333 inset;
  writing-mode: horizontal-tb;
  word-break: break-word;
}

.vertical-head {
  width: 80px;
  height: 80px;
}
.dayOfWeek-head {
  width: 80px;
  height: 40px;
}

td {
  text-align: center;
  width: 160px;
  height: 90px;
  font-weight: bold;
}
</style>

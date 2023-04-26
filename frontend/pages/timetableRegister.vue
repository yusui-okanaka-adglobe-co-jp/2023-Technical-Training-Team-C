<template>
  <default-layout page-name="教師用登録ページ">
    <body>
      <div class="date-set">
        開始日、終了日：<calendar-modal-register> </calendar-modal-register>
        <!-- @update:value="selectendDate" -->
      </div>

      <p>
        <button class="usual-button home" onclick="location.href='./home'">
          <div>ホーム</div>
        </button>
      </p>
      <p>
        <button class="usual-button studentHome" onclick="window.open('/studentHome')">
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

const today = new Date()
console.log(today)

import { Timetable } from '~~/types/response/timetablesAcquireResponse'
// import { TimetableComponentRegister } from '~~/.nuxt/components'
// import TimetableComponentRegister from '~~/components/timetable-component-register.vue'
/* 検証用オブジェクト */
const timetables: Timetable[] = [
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

<style lang="scss" scoped>
@import '../assets/scss/timetable.scss';

$background-color: #eaeaea;

body {
  padding-left: 20px;
}

input {
  margin-top: 40px;
  width: 224px;
  height: 40px;
  // padding-right: 160px;
}

.date-set {
  padding-left: 300px;
  font-size: 24px;
  margin-top: 46px;
}

.home {
  color: #5160ae;
  font-size: 24px;
}

.studentHome {
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

// カレンダーダイアログのscss
@import '@vuepic/vue-datepicker/src/VueDatePicker/style/main.scss';
</style>

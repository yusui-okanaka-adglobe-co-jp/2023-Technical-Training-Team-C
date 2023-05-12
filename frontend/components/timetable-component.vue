<template>
  <table class="timetable">
    <tbody>
      <!--最初の列 空白と時間割の時限を置く-->
      <tr>
        <th class="vertical-head horizontal-writing"></th>
        <th class="dayOfWeek-head horizontal-writing"></th>
        <!--時限表示ループ-->
        <template v-for="periodNumber of blankCell" :key="periodNumber">
          <TimetablePeriod :period="periodNumber"></TimetablePeriod>
        </template>
      </tr>
      <!--配列をループ-->
      <template v-for="timetable in props.timetables" :key="timetable">
        <tr>
          <!--日付、曜日表示-->
          <TimetableDate
            :is-holiday="timetable.isHoliday"
            :date="dateFormat(timetable.date)"
            :holiday-title="timetable.holidayTitle"
            :day-of-week="timetable.dayOfWeek"
          >
          </TimetableDate>
          <TimetableDayOfWeek :day-of-week="dayOfWeekChangeString(timetable.dayOfWeek)"></TimetableDayOfWeek>
          <!--祝日フラグで分岐-->
          <template v-if="timetable.isHoliday">
            <!--祝日処理-->
            <!--6回ループさせる-->
            <template v-for="holidayCell of blankCell" :key="holidayCell">
              <TimetableLesson :is-holiday="timetable.isHoliday"></TimetableLesson>
            </template>
          </template>
          <template v-else>
            <!--祝日以外処理-->
            <!--日曜判定-->
            <template v-if="timetable.dayOfWeek === 0">
              <!--日曜の処理-->
              <template v-for="lessons in timetable.lessons" :key="lessons">
                <TimetableLesson :is-holiday="true" :subject="lessons.subject" :teacher-name="lessons.teacher">
                </TimetableLesson>
              </template>
            </template>
            <!--日曜以外の処理-->
            <template v-else>
              <!--科目/教師のループ-->
              <template v-for="lessons in timetable.lessons" :key="lessons">
                <TimetableLesson
                  :is-holiday="timetable.isHoliday"
                  :subject="lessons.subject"
                  :teacher-name="lessons.teacher"
                >
                </TimetableLesson>
              </template>
            </template>
          </template>
        </tr>
      </template>
    </tbody>
  </table>
</template>

<script lang="ts" setup>
import { Timetable } from '~~/types/response/timetablesAcquireResponse'
import { format } from 'date-fns'

const props = defineProps({
  timetables: {
    type: Array as () => Timetable[],
    required: true,
    default: () => [
      {
        date: '',
        dayOfWeek: 0,
        isHoliday: false,
        lessons: () => [],
        holidayTitle: '',
      },
    ],
  },
})
/* 6回回す用　*/
const blankCell = 6

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
</script>

<style lang="scss" scoped>
@import '../assets/scss/timetable.scss';
</style>

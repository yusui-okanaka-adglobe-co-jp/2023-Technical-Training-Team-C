<template>
  <table class="timetable">
    <!--最初の列 空白と時間割の時限を置く-->
    <tr>
      <th class="dayOfWeek-head horizontal-writing"></th>
      <!--時限表示ループ-->
      <template v-for="periodNumber of blankCell" :key="periodNumber">
        <TimetablePeriod :period="periodNumber"></TimetablePeriod>
      </template>
    </tr>
    <!--配列をループ-->
    <template v-for="timetable in props.timetables" :key="timetable">
      <tr>
        <TimetableDayOfWeek :day-of-week="dayOfWeekChangeString(timetable.dayOfWeek)"></TimetableDayOfWeek>

        <!--科目/教師のループ-->
        <template v-for="lessons in timetable.lessons" :key="lessons">
          <TimetableLessonRegister :subject="lessons.subject" :teacher-name="lessons.teacher">
          </TimetableLessonRegister>
        </template>
      </tr>
    </template>
  </table>
</template>

<script lang="ts" setup>
import { TimetableRegister } from '~~/types/response/timetablesRegisterResponse'
import { format } from 'date-fns'
const props = defineProps({
  timetables: {
    type: Array as () => TimetableRegister[],
    required: true,
    default: () => [
      {
        dayOfWeek: 0,
        lessons: () => [],
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

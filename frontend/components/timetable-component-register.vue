<template>
  <table class="timetable">
    <!--最初の列 空白と時間割の時限を置く-->
    <!--配列をループ-->
    <template v-for="timetable in props.timetables" :key="timetable">
      <tr>
        <!-- 曜日のループ -->
        <TimetableDayOfWeek :day-of-week="dayOfWeekChangeString(timetable.dayOfWeek)"></TimetableDayOfWeek>

        <!--科目/教師のループ-->
        <template v-for="(lesson, index) of timetable.lessons" :key="lesson">
          <TimetableLessonRegister
            :dayOfWeek="dayOfWeekChangeString(timetable.dayOfWeek)"
            :period="index + 1"
            v-model:subject="lesson.subject"
            v-model:teacher-name="lesson.teacher"
          >
          </TimetableLessonRegister>
        </template>
      </tr>
    </template>
  </table>
</template>

<script lang="ts" setup>
import { TimetableRegister } from '~~/types/response/timetablesRegisterResponse'
import { format } from 'date-fns'
import TimetableComponent from './timetable-component.vue'
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

const emit = defineEmits(['update:timetables'])
for (const timetable of props.timetables) {
  for (const lesson of timetable.lessons) {
    watch(lesson, () => {
      emit('update:timetables', lesson)
    })
  }
}

/* 6回回す用　*/
const blankCell = 6
const periodincre = 0
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

function countup(number: number) {
  return number + 1
}

/* dateのフォーマット整える */
function dateFormat(date: string) {
  return format(new Date(date), 'M/d')
}

function test() {
  console.log(props.timetables)
}
</script>

<style lang="scss" scoped>
@import '../assets/scss/timetable.scss';
</style>

<template>
  <table class="timetable register">
    <tbody>
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
    </tbody>
  </table>
</template>

<script lang="ts" setup>
import { Timetable } from '~~/types/response/timetablesAcquireResponse'

const props = defineProps({
  timetables: {
    type: Array as () => Timetable[],
    required: true,
    default: () => [
      {
        dayOfWeek: 0,
        isHoliday: false,
        date: new Date(),
        lessons: () => [],
      },
    ],
  },
})

const emit = defineEmits(['update:timetables'])
for (const timetable of props.timetables) {
  for (const lesson of timetable.lessons ?? []) {
    watch(
      () => lesson,
      () => {
        emit('update:timetables', lesson)
      }
    )
  }
}

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
</script>

<style lang="scss" scoped>
@import '../assets/scss/timetable.scss';
</style>
